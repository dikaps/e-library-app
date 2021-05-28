<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    cek_login();
    cek_user();
  }

  public function index()
  {
    $data['judul'] = 'Dashboard';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data['anggota'] = $this->ModelUser->getUserLimit()->result_array();
    $data['buku'] = $this->ModelBuku->getLimitBuku()->result_array();

    $query = "SELECT *
                  FROM booking, 
                       booking_detail
                  WHERE DAY(curdate()) < DAY(batas_ambil)
                        AND booking.id_booking = booking_detail.id_booking

        ";
    $detail = $this->db->query($query)->result_array();
    foreach ($detail as $key) {
      $id_buku = $key['id_buku'];
      $batas = $key['tgl_booking'];
      $tglawal = date_create($batas);
      $tglskrng = date_create();
      $beda = date_diff($tglawal, $tglskrng);
      if ($beda->days > 2) {
        $query = "  UPDATE buku
                            SET stok = stok+1,
                                dibooking = dibooking-1
                            WHERE id = '$id_buku'
                ";
        $this->db->query($query);
      }
    }

    $booking = $this->ModelBooking->getData('booking');
    if (!empty($booking)) {
      foreach ($booking as $b) {
        $id_booking = $booking->id_booking;
        $batas = $booking->tgl_booking;
        $tglawal = date_create($batas);
        $tglskrng = date_create();
        $beda = date_diff($tglawal, $tglskrng);

        if ($beda->days > 2) {
          $q1 = "DELETE FROM booking
                    WHERE id_booking = '$id_booking'
          ";

          $q2 = "DELETE FROM booking_detail
                    WHERE id_booking = '$id_booking'
          ";
          $this->db->query($q1);
          $this->db->query($q2);
        }
      }
    }

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer');
  }
}
