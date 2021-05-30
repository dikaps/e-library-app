<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    cek_login();
    cek_user();
    date_default_timezone_set("Asia/Jakarta");
  }

  public function index()
  {
    $data = [
      'judul'  => "Daftar Booking",
      'user'   => $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
      'pinjam' => $this->ModelPinjam->joinData()
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('pinjam/data-pinjam', $data);
    $this->load->view('templates/footer');
  }

  public function getTotalDenda()
  {
    $noPinjam = $this->input->post('noPinjam', true);
    $denda = 5000;

    $result = $this->db->get_where('pinjam', ['no_pinjam' => $noPinjam])->row_array();
    $tgl1 = new DateTime($result['tgl_pinjam']);
    $tgl = new DateTime();
    $selisih = $tgl->diff($tgl1)->format("%a");
    $total = $selisih * $denda;
    echo $total;
  }

  public function daftarBooking()
  {
    $data = [
      'judul'  => "Daftar Booking",
      'user'   => $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(),
      'pinjam' => $this->db->query('SELECT booking.*, user.nama FROM booking INNER JOIN user ON user.id = booking.id_user')->result_array()
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('booking/daftar-booking', $data);
    $this->load->view('templates/footer');
  }

  public function detailBooking()
  {
    $id_booking = $this->input->post('idBooking', true);
    $output = "";

    $this->db->select('booking.*, booking_detail.*, user.nama, buku.judul_buku, buku.*');
    $this->db->from('booking');
    $this->db->where('booking.id_booking', $id_booking);
    $this->db->join('booking_detail', 'booking_detail.id_booking = booking.id_booking');
    $this->db->join('user', 'user.id = booking.id_user');
    $this->db->join('buku', 'buku.id = booking_detail.id_buku');
    $pinjam = $this->db->get()->result_array();
    $i = 1;
    foreach ($pinjam as $p) {
      $output .= '
        <tr>
          <td>' . $p['judul_buku'] . '</td>
          <td>' . $p['pengarang'] . '</td>
          <td>' . $p['penerbit'] . '</td>
          <td>' . $p['tahun_terbit'] . '</td>
        </tr>
      ';
    }
    echo $output;
  }

  public function getBooking()
  {
    $idBooking = $this->input->post('idBooking', true);

    $this->db->select('booking.*, user.nama');
    $this->db->join('user', 'user.id = booking.id_user');
    $result = $this->db->get_where('booking', ['id_booking' => $idBooking])->row_array();
    echo json_encode($result);
  }

  public function pinjamAct()
  {
    $id_booking = $this->uri->segment(3);
    $lama = $this->input->post('lama', true);

    $bo = $this->db->query("SELECT * FROM booking WHERE id_booking = '$id_booking'")->row();

    $tglSekarang = date('Y-m-d');
    $no_pinjam = $this->ModelBooking->kodeOtomatis('pinjam', 'no_pinjam');

    $dataBooking = [
      'no_pinjam'        => $no_pinjam,
      'id_booking'       => $id_booking,
      'tgl_pinjam'       => $tglSekarang,
      'id_user'          => $bo->id_user,
      'tgl_kembali'      => date('Y-m-d', strtotime('+' . $lama . ' days', strtotime($tglSekarang))),
      'tgl_pengembalian' => 0000 - 00 - 00,
      'status'    => 'Pinjam',
      'total_denda'      => 0
    ];

    $this->ModelPinjam->simpanPinjam($dataBooking);
    $this->ModelPinjam->simpanDetail($id_booking, $no_pinjam);
    $denda = $this->input->post('denda', true);

    $this->ModelPinjam->deleteData('booking_detail', ['id_booking' => $id_booking]);
    $this->ModelPinjam->deleteData('booking', ['id_booking' => $id_booking]);
    $denda = $this->input->post('denda', TRUE);
    $this->db->query("update detail_pinjam set denda='$denda'");


    $queryUpdate = "UPDATE buku,
                           detail_pinjam
                    SET buku.dipinjam = buku.dipinjam + 1,
                        buku.dibooking = buku.dibooking - 1
                    WHERE buku.id = detail_pinjam.id_buku
    ";
    $this->db->query($queryUpdate);

    $this->session->set_flashdata('pesan', 'Konfirmasi peminjaman berhasil dilakukan!');
    $this->session->set_flashdata('rules', 'berhasil');
    redirect(base_url('pinjam'));
  }

  public function ubahStatus()
  {
    $id_buku = $this->uri->segment(3);
    $no_pinjam = $this->uri->segment(4);
    $total_denda = $this->input->post('totaldenda', true);

    $tgl = date('Y-m-d');
    $status = 'Kembali';

    // update status pengembalian
    $query = "UPDATE  pinjam,
                      detail_pinjam
              SET pinjam.status = '$status',
                  pinjam.tgl_pengembalian = '$tgl',
                  pinjam.total_denda = '$total_denda'
              WHERE detail_pinjam.id_buku = '$id_buku'
                    AND pinjam.no_pinjam = '$no_pinjam'
    ";
    $this->db->query($query);

    // update status stok
    $query = "UPDATE buku, 
                     detail_pinjam
              SET buku.dipinjam = buku.dipinjam - 1,
                  buku.stok = buku.stok + 1
              WHERE buku.id = detail_pinjam.id_buku
    ";
    $this->db->query($query);
    $this->session->set_flashdata('pesan', 'Konfirmasi Ubah Status berhasil!');
    $this->session->set_flashdata('rules', 'berhasil');
    redirect(base_url('pinjam'));
  }
}
