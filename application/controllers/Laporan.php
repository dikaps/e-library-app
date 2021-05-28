<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  // laporan buku
  public function laporan_buku()
  {
    $data['judul'] = 'Laporan Data Buku';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('buku/laporan_buku', $data);
    $this->load->view('templates/footer');
  }

  public function cetak_laporan_buku()
  {
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

    $this->load->view('buku/laporan_print_buku', $data);
  }

  public function laporan_buku_pdf()
  {
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();

    $this->load->view('buku/laporan_pdf_buku', $data);

    $paper_size = 'A4';
    $orientation = 'landscape';
    $html = $this->output->get_output();

    $this->load->library('pdf');

    $this->pdf->generate($html, "Laporan_data_buku", $paper_size, $orientation);
  }

  public function export_excel()
  {
    $data = [
      'title' => 'Laporan Buku',
      'buku'  => $this->ModelBuku->getBuku()->result_array()
    ];

    $this->load->view('buku/export_excel_buku', $data);
  }

  // laporan anggota
  public function laporan_anggota()
  {
    $data['judul'] = 'Laporan Data Anggota';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data['anggota'] = $this->db->get_where('user', ['role_id' => 2])->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('buku/laporan_anggota', $data);
    $this->load->view('templates/footer');
  }

  public function cetak_laporan_anggota()
  {
    $data['anggota'] = $this->ModelUser->cekData(['role_id' => 2])->result_array();

    $this->load->view('buku/laporan_print_anggota', $data);
  }

  public function laporan_anggota_pdf()
  {
    $data['anggota'] = $this->ModelUser->cekData(['role_id' => 2])->result_array();
    $this->load->view('buku/laporan_pdf_anggota', $data);

    $paper_size = "A4";
    $orientation = "landscape";
    $html = $this->output->get_output();

    $this->load->library('pdf');

    $this->pdf->generate($html, "Laporan_data_anggota", $paper_size, $orientation);
  }

  public function export_excel_anggota()
  {
    $data = [
      'title' => 'Laporan Anggota',
      'anggota'  => $this->ModelUser->cekData(['role_id' => 2])->result_array()
    ];

    $this->load->view('buku/export_excel_anggota', $data);
  }

  public function laporan_pinjam()
  {
    $data['judul'] = "Laporan Data Peminjam";
    $data['user']  = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $query = "SELECT * 
              FROM pinjam p,
                   detail_pinjam d,
                   buku b,
                   user u
              WHERE d.id_buku=b.id
                    AND
                      p.id_user = u.id
                    AND
                      p.no_pinjam=d.no_pinjam
    ";
    $data['laporan'] = $this->db->query($query)->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('pinjam/laporan-pinjam', $data);
    $this->load->view('templates/footer');
  }

  // Cetak Laporan Pinjam
  public function cetak_laporan_pinjam()
  {
    $query = "SELECT * 
              FROM pinjam p,
                   detail_pinjam d,
                   buku b,
                   user u
              WHERE d.id_buku=b.id
                    AND
                      p.id_user = u.id
                    AND
                      p.no_pinjam=d.no_pinjam
    ";
    $data['laporan'] = $this->db->query($query)->result_array();

    $this->load->view('pinjam/laporan_print_pinjam', $data);
  }

  public function laporan_pinjam_pdf()
  {
    $query = "SELECT * 
              FROM pinjam p,
                   detail_pinjam d,
                   buku b,
                   user u
              WHERE d.id_buku=b.id
                    AND
                      p.id_user = u.id
                    AND
                      p.no_pinjam=d.no_pinjam
    ";
    $data['laporan'] = $this->db->query($query)->result_array();
    $this->load->view('pinjam/laporan_pdf_pinjam', $data);

    $paper_size = "A4";
    $orientation = "landscape";
    $html = $this->output->get_output();

    $this->load->library('pdf');

    $this->pdf->generate($html, "Laporan_data_peminjaman", $paper_size, $orientation);
  }

  public function export_excel_pinjam()
  {
    $query = "SELECT * 
              FROM pinjam p,
                   detail_pinjam d,
                   buku b,
                   user u
              WHERE d.id_buku=b.id
                    AND
                      p.id_user = u.id
                    AND
                      p.no_pinjam=d.no_pinjam
    ";
    $data = [
      'title'    => 'Laporan Data Peminjaman Buku',
      'laporan'  => $this->db->query($query)->result_array()
    ];

    $this->load->view('pinjam/export_excel_pinjam', $data);
  }
}
