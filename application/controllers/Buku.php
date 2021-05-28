<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    cek_login();
  }

  //manajemen Buku
  public function index()
  {
    $data['judul'] = 'Data Buku';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

    $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [
      'required' => 'Judul Buku harus diisi',
      'min_length' => 'Judul buku terlalu pendek'
    ]);
    $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
      'required' => 'Nama pengarang harus diisi',
    ]);
    $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
      'required' => 'Nama pengarang harus diisi',
      'min_length' => 'Nama pengarang terlalu pendek'
    ]);
    $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
      'required' => 'Nama penerbit harus diisi',
      'min_length' => 'Nama penerbit terlalu pendek'
    ]);
    $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
      'required' => 'Tahun terbit harus diisi',
      'min_length' => 'Tahun terbit terlalu pendek',
      'max_length' => 'Tahun terbit terlalu panjang',
      'numeric' => 'Hanya boleh diisi angka'
    ]);
    $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
      'required' => 'Nama ISBN harus diisi',
      'min_length' => 'Nama ISBN terlalu pendek',
      'numeric' => 'Yang anda masukan bukan angka'
    ]);
    $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
      'required' => 'Stok harus diisi',
      'numeric' => 'Yang anda masukan bukan angka'
    ]);

    //konfigurasi sebelum gambar diupload
    $config['upload_path'] = './assets/img/upload/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size'] = '3000';
    $config['file_name'] = 'img' . time();

    $this->load->library('upload', $config);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('buku/index', $data);
      $this->load->view('templates/footer');
    } else {
      if ($this->input->post('id_kategori', true) == 'null') {
        $this->session->set_flashdata('pesan', 'Kategori yang anda pilih salah!');
        $this->session->set_flashdata('rules', 'gagal');
        redirect('buku');
      }
      if ($this->upload->do_upload('image')) {
        $image = $this->upload->data();
        $gambar = $image['file_name'];
      } else {
        $gambar = '';
      }

      $data = [
        'judul_buku'   => $this->input->post('judul_buku', true),
        'id_kategori'  => $this->input->post('id_kategori', true),
        'pengarang'    => $this->input->post('pengarang', true),
        'penerbit'     => $this->input->post('penerbit', true),
        'tahun_terbit' => $this->input->post('tahun_terbit', true),
        'isbn'         => $this->input->post('isbn', true),
        'stok'         => $this->input->post('stok', true),
        'dipinjam'     => 0,
        'dibooking'    => 0,
        'image'        => $gambar,
        'jml_halaman'  => $this->input->post('jml_halaman', true),
      ];

      $this->ModelBuku->simpanBuku($data);
      $this->session->set_flashdata('pesan', 'Buku Baru Berhasil ditambahkan');
      $this->session->set_flashdata('rules', 'berhasil');
      redirect('buku');
    }
  }

  public function getBuku()
  {
    $id = $this->input->post('id', true);

    $result = $this->db->get_where('buku', ['id' => $id])->row_array();
    echo json_encode($result);
  }

  public function hapusBuku()
  {
    $where = ['id' => $this->uri->segment(3)];
    $this->ModelBuku->hapusBuku($where);

    $this->session->set_flashdata('pesan', 'Buku Berhasil dihapus!');
    $this->session->set_flashdata('rules', 'berhasil');

    redirect('buku');
  }

  public function ubahBuku()
  {
    $data['judul'] = 'Ubah Data Buku';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data['buku'] = $this->ModelBuku->bukuWhere(['id' => $this->uri->segment(3)])->row_array();
    $kategori = $this->ModelBuku->joinKategoriBuku(['buku.id' => $this->uri->segment(3)])->result_array();
    foreach ($kategori as $k) {
      $data['id'] = $k['id_kategori'];
      $data['k'] = $k['kategori'];
    }
    $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

    $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [
      'required' => 'Judul Buku harus diisi',
      'min_length' => 'Judul buku terlalu pendek'
    ]);
    $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
      'required' => 'Nama pengarang harus diisi',
    ]);
    $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
      'required' => 'Nama pengarang harus diisi',
      'min_length' => 'Nama pengarang terlalu pendek'
    ]);
    $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
      'required' => 'Nama penerbit harus diisi',
      'min_length' => 'Nama penerbit terlalu pendek'
    ]);
    $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
      'required' => 'Tahun terbit harus diisi',
      'min_length' => 'Tahun terbit terlalu pendek',
      'max_length' => 'Tahun terbit terlalu panjang',
      'numeric' => 'Hanya boleh diisi angka'
    ]);
    $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
      'required' => 'Nama ISBN harus diisi',
      'min_length' => 'Nama ISBN terlalu pendek',
      'numeric' => 'Yang anda masukan bukan angka'
    ]);
    $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
      'required' => 'Stok harus diisi',
      'numeric' => 'Yang anda masukan bukan angka'
    ]);

    //konfigurasi sebelum gambar diupload
    $config['upload_path'] = './assets/img/upload/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size'] = '3000';
    $config['max_width'] = '1024';
    $config['max_height'] = '1000';
    $config['file_name'] = 'img' . time();

    //memuat atau memanggil library upload
    $this->load->library('upload', $config);

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('pesan', validation_errors());
      $this->session->set_flashdata('rules', 'gagal');
      redirect('buku');
    } else {
      if ($this->upload->do_upload('image')) {
        $image = $this->upload->data();
        unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
        $gambar = $image['file_name'];
      } else {
        $gambar = $this->input->post('old_pict', TRUE);
      }

      $data = [
        'judul_buku' => $this->input->post('judul_buku', true),
        'id_kategori' => $this->input->post('id_kategori', true),
        'pengarang' => $this->input->post('pengarang', true),
        'penerbit' => $this->input->post('penerbit', true),
        'tahun_terbit' => $this->input->post('tahun_terbit', true),
        'isbn' => $this->input->post('isbn', true),
        'stok' => $this->input->post('stok', true),
        'image' => $gambar
      ];

      $id = $this->uri->segment(3);
      $this->ModelBuku->updateBuku($data, ['id' => $id]);
      $this->session->set_flashdata('pesan', 'Buku Berhasil dirubah');
      $this->session->set_flashdata('rules', 'berhasil');
      redirect('buku');
    }
  }

  //manajemen kategori
  public function kategori()
  {
    $data['judul'] = 'Kategori Buku';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

    $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
      'required' => 'Nama Kategori harus diisi'
    ]);


    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('buku/kategori', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'kategori' => $this->input->post('kategori', TRUE)
      ];

      $cek = $this->db->get_where('kategori', ['kategori' => $data['kategori']])->num_rows();
      if ($cek) {
        $this->session->set_flashdata('pesan', 'Kategori Sudah ada!');
        $this->session->set_flashdata('rules', 'gagal');
        redirect('buku/kategori');
      }

      $this->ModelBuku->simpanKategori($data);
      $this->session->set_flashdata('pesan', 'Kategori Baru Berhasil ditambahkan');
      $this->session->set_flashdata('rules', 'berhasil');
      redirect('buku/kategori');
    }
  }

  public function getKategori()
  {
    $id = $this->input->post('id', true);
    $result = $this->db->get_where('kategori', ['id' => $id])->row_array();
    echo json_encode($result);
  }

  public function ubahKategori()
  {
    $id = $this->input->post('idKategori', true);

    $data = [
      'kategori' => $this->input->post('kategori', true)
    ];

    $this->ModelBuku->updateKategori(['id' => $id], $data);
    $this->session->set_flashdata('pesan', 'Kategori Berhasil diubah!');
    $this->session->set_flashdata('rules', 'berhasil');
    redirect('buku/kategori');
  }

  public function hapusKategori()
  {
    $where = ['id' => $this->uri->segment(3)];

    $this->ModelBuku->hapusKategori($where);

    $this->session->set_flashdata('pesan', 'Kategori Berhasil dihapus!');
    $this->session->set_flashdata('rules', 'berhasil');

    redirect('buku/kategori');
  }
}
