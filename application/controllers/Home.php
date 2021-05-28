<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data = [
      'judul' => "Katalog Buku",
    ];
    $count = $this->input->post('counting');
    if (!$count) {
      $count = 3;
    }

    $this->db->limit($count);
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();

    $this->db->join('kategori', 'kategori.id = buku.id_kategori');
    $data['upstok'] = $this->ModelBuku->getBuku()->row_array();
    if ($this->session->userdata('email')) {
      $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

      $data['user'] = $user['nama'];

      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('buku/daftarbuku', $data);
      $this->load->view('templates/templates-user/footer', $data);
    } else {
      $data['user'] = 'Pengunjung';

      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('buku/daftarbuku', $data);
      $this->load->view('templates/templates-user/footer', $data);
    }
  }

  public function detailBuku()
  {
    $id = $this->uri->segment(3);
    if ($this->session->userdata('email')) {
      $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
      $data['user'] = $user['nama'];
    } else {
      $data['user'] = "Pengunjung";
    }
    $data['title'] = "Detail Buku";


    $buku = $this->ModelBuku->joinKategoriBuku(['buku.id' => $id])->result();
    foreach ($buku as $fields) {
      $data['judul'] = $fields->judul_buku;
      $data['pengarang'] = $fields->pengarang;
      $data['penerbit'] = $fields->penerbit;
      $data['kategori'] = $fields->kategori;
      $data['tahun'] = $fields->tahun_terbit;
      $data['isbn'] = $fields->isbn;
      $data['gambar'] = $fields->image;
      $data['dipinjam'] = $fields->dipinjam;
      $data['dibooking'] = $fields->dibooking;
      $data['stok'] = $fields->stok;
      $data['id'] = $id;
      $data['halaman'] = $fields->jml_halaman;
    }

    $this->load->view('templates/templates-user/header', $data);
    $this->load->view('buku/detail-buku', $data);
    $this->load->view('templates/templates-user/footer');
  }

  public function loadBuku()
  {
    $count = $this->input->post('counting');
    $output = "";
    if (!$count) {
      $count = 3;
    }

    $this->db->limit($count);
    $buku = $this->db->get('buku')->result_array();
    foreach ($buku as $b) {
      if ($b['stok'] < 1) {
        $btnBooking = '
          <a href="#" class="btn-buku booking">
            <svg class="mr-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
  
            Kosong
          </a>
        ';
      } else {
        $btnBooking = '
          <a href="' . base_url('booking/tambahBooking/' . $b['id']) . '" class="btn-buku booking">
            <svg class="mr-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
  
            Booking
          </a>
        ';
      }

      $output .= '
        <!-- card -->
      <div class="card-buku">
        <!-- box 1 -->
        <div class="flex items-center sm:flex-row flex-col">
          <!-- image card -->
          <div class="bg-gray-300 w-28 h-28 rounded-lg overflow-hidden sm:mr-5 mr-0">
            <a href="#">
              <img src="' . base_url('assets/img/upload/' . $b['image']) . '" alt="Image - ' . $b['judul_buku'] . '" />
            </a>
          </div>

          <!-- title card & sub title -->
          <div class="flex flex-col sm:my-0 my-3 text-center sm:text-left">
            <h2 class="sm:text-xl text-sm font-medium">' . $b['judul_buku'] . '</h2>
            <p class="font-light text-gray-400">' . $b['pengarang'] . '.</p>
          </div>
        </div>
        <!-- action card -->
        <div class="flex flex-col">
          ' . $btnBooking . '
          <a href="' . base_url('home/detailBuku/' . $b['id']) . '" class="btn-buku detail mt-2">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="12" y1="16" x2="12" y2="12"></line>
              <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            Detail
          </a>
        </div>
      </div>
      <!-- /card -->
      ';
    }

    echo $output;
  }
}
