<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    cek_login();
  }
  public function index()
  {
    $id_user = $this->session->userdata('id_user');

    $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data = [
      'image' => $user['image'],
      'user' => $user['nama'],
      'email' => $user['email'],
      'tanggal_input' => $user['tanggal_input']
    ];

    $dtb = $this->ModelBooking->showtemp(['id_user' => $id_user])->num_rows();
    if ($dtb < 1) {
      $this->session->set_flashdata('type', 'Gagal!');
      $this->session->set_flashdata('pesan', 'Tidak Ada Buku dikeranjang');
      redirect(base_url());
    } else {
      $data['temp'] = $this->db->query("select image, judul_buku, penulis, penerbit, tahun_terbit,id_buku from temp where id_user='$id_user'")->result_array();
    }
    $data['judul'] = "Data Booking";
    $this->load->view('templates/templates-user/header', $data);
    $this->load->view('booking/data-booking', $data);
    $this->load->view('templates/templates-user/footer');
  }

  public function tambahBooking()
  {
    $id_buku = $this->uri->segment(3);
    $d = $this->db->query("Select * from buku where id='$id_buku'")->row();

    $isi = [
      'id_buku' => $id_buku,
      'judul_buku' => $d->judul_buku,
      'id_user' => $this->session->userdata('id_user'),
      'email_user' => $this->session->userdata('email'),
      'tgl_booking' => date('Y-m-d H:i:s'),
      'image' => $d->image,
      'penulis' => $d->pengarang,
      'penerbit' => $d->penerbit,
      'tahun_terbit' => $d->tahun_terbit
    ];

    $temp = $this->ModelBooking->getDataWhere('temp', ['id_buku' => $id_buku])->num_rows();

    $userid = $this->session->userdata('id_user');
    $tempuser = $this->db->query("select*from temp where id_user ='$userid'")->num_rows();

    $databooking = $this->db->query("select * from booking where id_user='$userid'")->num_rows();
    if ($databooking > 0) {
      $dataPesan = [
        'type' => 'Gagal',
        'pesan' => 'Masih Ada booking buku sebelumnya yang belum diambil.<br> Ambil Buku yang dibooking atau tunggu 1x24 Jam untuk bisa booking kembali'
      ];
      echo json_encode($dataPesan);
      return false;
      die;
    }

    if ($temp > 0) {
      $dataPesan = [
        'type' => 'Gagal',
        'pesan' => 'Buku ini Sudah anda booking'
      ];
      echo json_encode($dataPesan);
      return false;
      die;
    }

    if ($tempuser == 3) {
      $dataPesan = [
        'type' => 'Gagal',
        'pesan' => 'Booking Buku Tidak Boleh Lebih dari 3'
      ];
      echo json_encode($dataPesan);
      return false;
      die;
    }

    $this->ModelBooking->createTemp();
    $this->ModelBooking->insertData('temp', $isi);
    $dataPesan = [
      'type' => 'Berhasil',
      'pesan' => 'Buku berhasil ditambahkan ke keranjang'
    ];
    echo json_encode($dataPesan);
  }

  public function getJumlahBooking()
  {
    $result = $this->ModelBooking->getDataWhere('temp', ['email_user' => $this->session->userdata('email')])->num_rows();
    $data = [
      'hasil' => $result
    ];
    echo json_encode($data);
  }

  public function hapusbooking()
  {
    $id_buku = $this->uri->segment(3);
    $id_user = $this->session->userdata('id_user');

    $this->ModelBooking->deleteData(['id_buku' => $id_buku], 'temp');
    $kosong = $this->db->query("select*from temp where id_user='$id_user'")->num_rows();

    if ($kosong < 1) {
      $dataPesan = [
        'type' => 'Warning',
        'pesan' => 'Tidak ada buku dalam keranjang',
        'hasil' => 'kosong'
      ];
      echo json_encode($dataPesan);
    } else {
      $dataPesan = [
        'type' => 'Berhasil',
        'pesan' => 'Buku berhasil dihapus',
        'hasil' => 'ada'
      ];
      echo json_encode($dataPesan);
    }
  }

  public function loadDataBooking()
  {
    $id_user = $this->session->userdata('id_user');
    $output = "";

    $dtb = $this->ModelBooking->showtemp(['id_user' => $id_user])->num_rows();

    if ($dtb < 1) {
      $this->session->set_flashdata('pesan', '<div class="alert pesan alert-danger" >Tidak Ada Buku dikeranjang</div>');
      redirect(base_url());
    } else {
      $temp = $this->db->query("select image, judul_buku, penulis, penerbit, tahun_terbit,id_buku from temp where id_user='$id_user'")->result_array();

      foreach ($temp as $t) {
        $output .= '
          <tr>
            <td class="p-2"><?= $i++; ?></td>
            <td class="w-28 p-2">
              <img src="' . base_url('assets/img/upload/' . $t['image']) . '" alt="" class="shadow-lg" />
            </td>
            <td class="p-2">' . $t['penulis'] . '</td>
            <td class="p-2">' . $t['penerbit'] . '</td>
            <td class="p-2">' . substr($t['tahun_terbit'], 0, 4) . '</td>
            <td class="p-2">
              <a href="' . base_url('booking/hapusbooking/' . $t['id_buku']) . '" class="px-4 py-2 grid place-content-center rounded bg-red-600 hover:bg-red-700 transition-colors btnKonfirmasi">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="3 6 5 6 21 6"></polyline>
                  <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                </svg>
              </a>
            </td>
          </tr>
        ';
      }
      echo $output;
    }
  }

  public function bookingSelesai($where)
  {
    $this->db->query("UPDATE buku, temp SET buku.dibooking = buku.dibooking+1, buku.stok = buku.stok-1 WHERE buku.id = temp.id_buku");

    $tglsekarang = date('Y-m-d');
    $isibooking = [
      'id_booking' => $this->ModelBooking->kodeOtomatis('booking', 'id_booking'),
      'tgl_booking' => date('Y-m-d H:m:s'),
      'batas_ambil' => date('Y-m-d', strtotime('+2 days', strtotime($tglsekarang))),
      'id_user' => $where
    ];

    $this->ModelBooking->insertData('booking', $isibooking);
    $this->ModelBooking->simpanDetail($where);
    $this->ModelBooking->kosongkanData('temp');
    redirect(base_url() . 'booking/info');
  }

  public function info()
  {
    $where = $this->session->userdata('id_user');
    $data['user'] = $this->session->userdata('nama');
    $data['judul'] = "Selesai Booking";
    $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();
    $data['items'] = $this->db->query("select * from booking bo, booking_detail d, buku bu where d.id_booking = bo.id_booking and d.id_buku=bu.id and bo.id_user='$where'")->result_array();

    if (count($data['items']) < 1) {
      $this->session->set_flashdata('type', 'Gagal!');
      $this->session->set_flashdata('pesan', 'Tidak Ada Buku yang anda pesan!');
      redirect(base_url());
    }

    $this->load->view('templates/templates-user/header', $data);
    $this->load->view('booking/info-booking', $data);
    $this->load->view('templates/templates-user/footer');
  }

  public function exportToPdf()
  {
    $id_user = $this->session->userdata('id_user');
    $data['user'] = $this->session->userdata('nama');
    $data['judul'] = "Cetak Bukti Booking";
    $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->row_array();
    $query = "SELECT * 
              FROM booking bo, 
                   booking_detail d, 
                   buku bu 
              WHERE d.id_booking = bo.id_booking 
              AND   d.id_buku=bu.id 
              AND   bo.id_user = '$id_user'";
    $data['items'] = $this->db->query($query)->result_array();

    $this->load->view('booking/bukti-pdf', $data);


    $paper_size = 'A4'; // ukuran kertas
    $orientation = 'landscape'; //tipe format kertas potrait atau landscape
    $html = $this->output->get_output();

    $this->load->library('pdf');
    $nama = $data['user'];
    $this->pdf->generate($html, "bukti-booking-$nama", $paper_size, $orientation);
  }

  public function riwayatPinjam()
  {
    $id_buku = $this->uri->segment(3);


    $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

    $data = [
      'image' => $user['image'],
      'user' => $user['nama'],
      'email' => $user['email'],
      'tanggal_input' => $user['tanggal_input'],
    ];
    $data['judul'] = 'Riwayat Pinjam';

    $this->db->select('pinjam.*, detail_pinjam.id_buku, buku.*');
    $this->db->join('detail_pinjam', 'detail_pinjam.no_pinjam = pinjam.no_pinjam');
    $this->db->join('buku', 'buku.id = detail_pinjam.id_buku');
    $data['rp'] = $this->db->get_where('pinjam', ['detail_pinjam.id_buku' => $id_buku])->row_array();

    $this->load->view('templates/templates-user/header', $data);
    $this->load->view('booking/riwayat-pinjam', $data);
    $this->load->view('templates/templates-user/footer');
  }
}
