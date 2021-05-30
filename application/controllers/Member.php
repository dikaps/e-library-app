<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function myProfil()
  {
    $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

    $data = [
      'image' => $user['image'],
      'user' => $user['nama'],
      'email' => $user['email'],
      'tanggal_input' => $user['tanggal_input'],
    ];
    $data['judul'] = 'Profil Saya';

    $this->db->select('pinjam.*, detail_pinjam.id_buku, buku.judul_buku');
    $this->db->join('detail_pinjam', 'detail_pinjam.no_pinjam = pinjam.no_pinjam');
    $this->db->join('buku', 'buku.id = detail_pinjam.id_buku');
    $data['riwayat'] = $this->db->get_where('pinjam', ['id_user' => $user['id']])->result_array();

    $this->load->view('templates/templates-user/header', $data);
    $this->load->view('member/index', $data);
    $this->load->view('templates/templates-user/footer', $data);
  }

  public function ubahProfil()
  {
    $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

    $data = [
      'image' => $user['image'],
      'user' => $user['nama'],
      'email' => $user['email'],
      'alamat' => $user['alamat'],
      'no_telp' => $user['no_telp'],
      'tanggal_input' => $user['tanggal_input'],
    ];
    $data['judul'] = 'Profil Saya';
    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
      'required' => 'Nama tidak Boleh Kosong'
    ]);

    $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
      'required' => 'Alamat tidak Boleh Kosong'
    ]);

    $this->form_validation->set_rules('no_telp', 'No Telp', 'required|trim', [
      'required' => 'No Telp tidak Boleh Kosong'
    ]);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('member/ubah-anggota', $data);
      $this->load->view('templates/templates-user/footer', $data);
    } else {

      $nama = htmlspecialchars($this->input->post('nama', true));
      $email = htmlspecialchars($this->input->post('email', true));
      $alamat = $this->input->post('alamat', true);
      $no_telp = $this->input->post('no_telp', true);

      $data = [
        'nama' => $nama,
        'alamat' => $alamat,
        'no_telp' => $no_telp
      ];

      $upload_image = $_FILES['image']['name'];

      if ($upload_image) {
        $config['upload_path'] = './assets/img/profile/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '3000';
        $config['file_name'] = 'pro' . time();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
          $gambar_lama = $user['image'];

          if ($gambar_lama != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
          }

          $gambar_baru = $this->upload->data('file_name');
          $this->db->set('image', $gambar_baru);
        } else {
          'echo' . $this->upload->display_errors();
        }
      }

      $this->db->update('user', $data, ['email' => $email]);

      $this->session->set_flashdata('pesan', '<div class="alert alert-primary pesan mt-3" >Profil Berhasil diubah </div>');
      redirect('member/myprofil');
    }
  }


  public function logout()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');
    $this->session->set_flashdata('pesan', '<div class="alert alert-primary pesan mt-3" >Anda telah logout!!</div>');
    redirect('home');
  }
}
