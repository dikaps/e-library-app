<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    cek_login();
  }

  public function index()
  {
    $data['judul'] = 'Profil Saya';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('user/index', $data);
    $this->load->view('templates/footer');
  }

  public function getUser()
  {
    $id = $this->input->post('id', true);

    $res = $this->ModelUser->cekData(['id' => $id])->row_array();
    echo json_encode($res);
  }

  public function anggota()
  {
    $data['judul'] = 'Data Anggota';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $this->db->where('role_id', 1);
    $data['anggota'] = $this->db->get('user')->result_array();

    $this->form_validation->set_rules('nama', 'Nama Anggota', 'required|trim|min_length[3]', [
      'required' => 'Nama tidak boleh kosong!',
      'min_length' => 'Nama terlalu pendek'
    ]);

    $this->form_validation->set_rules('notel', 'No. Telp', 'required|trim|min_length[11]|max_length[13]|numeric', [
      'required' => 'No Telp. tidak boleh kosong!',
      'min_length' => 'No Telp. terlalu pendek',
      'max_length' => 'No Telp. terlalu panjang'
    ]);

    $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', [
      'required' => 'Alamat Email tidak boleh kosong!',
      'valid_email' => 'Email yang anda input tidak benar',
      'is_unique' => 'Email yang anda masukan telah terdafatar!'
    ]);

    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
      'required' => 'Password tidak boleh kosong!',
      'min_length' => 'Password anda terlalu pendek',
    ]);

    $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|min_length[3]|matches[password]', [
      'required' => 'Ulangi Password tidak boleh kosong!',
      'min_length' => 'Ulangi Password anda terlalu pendek',
      'matches'    => 'Ulangi password yang anda input tidak sama dengan password'
    ]);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/anggota', $data);
      $this->load->view('templates/footer');
    } else {
      $data = [
        'nama'          => $this->input->post('nama', true),
        'email'         => htmlspecialchars($this->input->post('email', true)),
        'no_telp'       => $this->input->post('notel', true),
        'alamat'        => $this->input->post('alamat', true),
        'password'      => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
        'is_active'     => 1,
        'role_id'       => 1,
        'tanggal_input' => time()
      ];

      $this->db->insert('user', $data);
      $this->session->set_flashdata('pesan', 'Anggota baru berhasil ditambahkan!');
      $this->session->set_flashdata('rules', 'berhasil');
      redirect('user/anggota');
    }
  }

  public function ubahAnggota()
  {
    $this->form_validation->set_rules('nama', 'Nama Anggota', 'required|trim|min_length[3]', [
      'required' => 'Nama tidak boleh kosong!',
      'min_length' => 'Nama terlalu pendek'
    ]);

    $this->form_validation->set_rules('notel', 'No. Telp', 'required|trim|min_length[11]|max_length[13]|numeric', [
      'required' => 'No Telp. tidak boleh kosong!',
      'min_length' => 'No Telp. terlalu pendek',
      'max_length' => 'No Telp. terlalu panjang'
    ]);

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('pesan', validation_errors());
      $this->session->set_flashdata('rules', 'gagal');
      redirect('user/anggota');
    } else {
      $data = [
        'nama'    => $this->input->post('nama', true),
        'no_telp' => $this->input->post('notel', true),
        'alamat'  => $this->input->post('alamat', true),
      ];


      $this->db->update('user', $data, ['id' => $this->uri->segment(3)]);
      $this->session->set_flashdata('pesan', 'Perubahan data anggota berhasil!');
      $this->session->set_flashdata('rules', 'berhasil');
      redirect('user/anggota');
    }
  }

  public function getAnggota()
  {
    $id = $this->input->post('id', true);

    $result = $this->db->get_where('user', ['id' => $id])->row_array();
    echo json_encode($result);
  }

  public function hapusAnggota()
  {
    $id = $this->uri->segment(3);

    $this->db->delete('user', ['id' => $id]);
    $this->session->set_flashdata('pesan', 'Penghapusan data anggota berhasil!');
    $this->session->set_flashdata('rules', 'berhasil');
    redirect('user/anggota');
  }

  public function ubahProfil()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]', [
      'required' => 'Nama tidak boleh kosong!',
      'min_length' => 'Nama terlalu pendek'
    ]);

    $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[3]', [
      'required' => 'Alamat tidak boleh kosong!',
      'min_length' => 'Alamat terlalu pendek'
    ]);

    $this->form_validation->set_rules('notel', 'No. Telp', 'required|trim|min_length[11]|max_length[13]|numeric', [
      'required' => 'No Telp. tidak boleh kosong!',
      'min_length' => 'No Telp. terlalu pendek',
      'max_length' => 'No Telp. terlalu panjang'
    ]);


    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('pesan', validation_errors());
      $this->session->set_flashdata('rules', 'berhasil');
      redirect('user');
    } else {
      $email = $this->input->post('email', true);

      $data = [
        'nama'    => $this->input->post('nama', true),
        'no_telp' => $this->input->post('notel', true),
        'alamat'  => $this->input->post('alamat', true)
      ];

      $this->db->where('email', $email);
      $this->db->update('user', $data, ['email' => $email]);

      $this->session->set_flashdata('pesan', 'Perubahan data berhasil!');
      $this->session->set_flashdata('rules', 'berhasil');
      redirect('user');
    }
  }

  public function ubahFoto()
  {
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    //jika ada gambar yang akan diupload
    $upload_image = $_FILES['image']['name'];

    if ($upload_image) {
      $config['upload_path'] = './assets/img/profile/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']     = '3000';
      $config['file_name'] = 'pro' . time();

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('image')) {
        $gambar_lama = $data['user']['image'];
        if ($gambar_lama != 'default.jpg') {
          unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
        }

        $gambar_baru = $this->upload->data('file_name');
        $this->db->set('image', $gambar_baru);
      } else {
        $this->session->set_flashdata('pesan', $this->upload->display_errors());
        $this->session->set_flashdata('rules', 'gagal');
        redirect('user');
      }
    } else {
      $this->session->set_flashdata('pesan', 'Tidak ada foto yang diupload!');
      $this->session->set_flashdata('rules', 'gagal');
      redirect('user');
    }

    $this->db->where('id', $this->uri->segment(3));
    $this->db->update('user');
    $this->session->set_flashdata('pesan', 'Perubahan foto berhasil!');
    $this->session->set_flashdata('rules', 'berhasil');
    redirect('user');
  }

  public function ubahPassword()
  {
    $data['judul'] = 'Ubah Password';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('password_sekarang', 'Password Saat ini', 'required|trim', [
      'required' => 'Password saat ini harus diisi'
    ]);

    $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[4]|matches[password_baru2]', [
      'required' => 'Password Baru harus diisi',
      'min_length' => 'Password tidak boleh kurang dari 4 digit',
      'matches' => 'Password Baru tidak sama dengan ulangi password'
    ]);

    $this->form_validation->set_rules('password_baru2', 'Konfirmasi Password Baru', 'required|trim|min_length[4]|matches[password_baru1]', [
      'required' => 'Ulangi Password harus diisi',
      'min_length' => 'Password tidak boleh kurang dari 4 digit',
      'matches' => 'Ulangi Password tidak sama dengan password baru'
    ]);

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('pesan', validation_errors());
      $this->session->set_flashdata('rules', 'gagal');
      redirect('user');
    } else {
      $pwd_skrg = $this->input->post('password_sekarang', true);
      $pwd_baru = $this->input->post('password_baru1', true);
      if (!password_verify($pwd_skrg, $data['user']['password'])) {
        $this->session->set_flashdata('pesan', 'Password Saat ini Salah!!!');
        $this->session->set_flashdata('rules', 'gagal');
        redirect('user');
      } else {
        if ($pwd_skrg == $pwd_baru) {
          $this->session->set_flashdata('pesan', 'Password Baru tidak boleh sama dengan password saat ini!!!');
          $this->session->set_flashdata('rules', 'gagal');
          redirect('user');
        } else {
          //password ok
          $password_hash = password_hash($pwd_baru, PASSWORD_DEFAULT);

          $this->db->set('password', $password_hash);
          $this->db->where('email', $this->session->userdata('email'));
          $this->db->update('user');

          $this->session->set_flashdata('pesan', 'Perubahan Password berhasil');
          $this->session->set_flashdata('rules', 'berhasil');
          redirect('user');
        }
      }
    }
  }
}
