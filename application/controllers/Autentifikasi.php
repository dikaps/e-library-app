<?php

class Autentifikasi extends CI_Controller
{

  public function index()
  {
    //jika statusnya sudah login, maka tidak bisa mengakses halaman login alias dikembalikan ke tampilan user
    if ($this->session->userdata('email')) {
      redirect('admin');
    }

    $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email', [
      'required' => 'Email Harus diisi!!',
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|trim', [
      'required' => 'Password Harus diisi'
    ]);
    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Login';
      $data['user'] = '';
      //kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header
      $this->load->view('templates/aute_header', $data);
      $this->load->view('autentifikasi/login');
      $this->load->view('templates/aute_footer');
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $email = htmlspecialchars($this->input->post('email', true));
    $password = $this->input->post('password', true);

    $user = $this->ModelUser->cekData(['email' => $email])->row_array();

    //jika usernya ada
    if ($user) {
      //jika user sudah aktif
      if ($user['is_active'] == 1) {
        //cek password
        if (password_verify($password, $user['password'])) {
          $data = [
            'email' => $user['email'],
            'role_id' => $user['role_id']
          ];

          $this->session->set_userdata($data);
          if ($user['role_id'] == 1) {
            redirect('admin');
          } else {
            redirect('home');
          }
        } else {
          $this->session->set_flashdata('pesan', '<div class="alert alert-danger pesan" role="alert">Password salah!!</div>');
          redirect('autentifikasi');
        }
      } else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger pesan" role="alert">User belum diaktifasi!!</div>');
        redirect('autentifikasi');
      }
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger pesan">Email/NIM Belum terdaftar!</div>');
      redirect('autentifikasi');
    }
  }

  public function registrasi()
  {
    if ($this->session->userdata('email')) {
      redirect('user');
    }

    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
      'required' => 'Nama Belum diis!!'
    ]);

    $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', [
      'valid_email' => 'Email Tidak Benar!!',
      'required' => 'Email Belum diisi!!',
      'is_unique' => 'Email Sudah Terdaftar!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'Password Tidak Sama!!',
      'min_length' => 'Password Terlalu Pendek'
    ]);
    $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Registrasi Member';
      $this->load->view('templates/aute_header', $data);
      $this->load->view('autentifikasi/registrasi');
      $this->load->view('templates/aute_footer');
    } else {
      $email = $this->input->post('email', true);
      $data = [
        'nama'          => htmlspecialchars($this->input->post('nama', true)),
        'alamat'        => htmlspecialchars($this->input->post('alamat', true)),
        'email'         => htmlspecialchars($email),
        'image'         => 'default.jpg',
        'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id'       => 2,
        'is_active'     => 0,
        'tanggal_input' => time(),
        'no_telp'       => $this->input->post('notel', true)
      ];

      $token = rand(1000, 9999);
      $user  = [
        'email' => $email,
        'token' => $token,
        'date_created' => time()
      ];

      $this->ModelUser->simpanData($data);
      $this->db->insert('token', $user);

      $this->_sendEmail($token, 'verifikasi');

      $this->session->set_flashdata('pesan', '<div class="alert alert-primary pesan"9>
        <div class="w-10">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
          </svg>
        </div>
        Selamat!! akun member anda sudah dibuat. Silahkan Aktivasi Akun anda
      </div>');

      $data = [
        'email' => $email,
        'type'  => 'registrasi'
      ];
      $this->session->set_userdata($data);
      redirect('autentifikasi/verifikasi');
    }
  }

  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'btisofficial@gmail.com',
      'smtp_pass' => 'btis1234',
      'smtp_port' => 465,
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'newline'   => "\r\n"
    ];

    $this->load->library('email', $config);

    $this->email->from('btisofficial@gmail.com', 'E-LIBRARY');
    $this->email->to($this->input->post('email', true));

    if ($type == 'verifikasi') {
      $this->email->subject('Verifikasi Akun');
      $message = '
        <div style="font-family: nunito, verdana">
          <h1>Hai, Terimakasih sudah bergabung dengan E-library</h1>
          <p>
            Kode verifikasi anda adalah : <span style="padding: 8px 25px; color: white; background-color: #0275d8; border-radius: 5px; letter-spacing: 2px; font-weight: 600; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);">' . $token . '</span>
          </p>
          <p>Kode verifikasi tersebut hanya berlaku 1x 24 Jam</p>
        </div>
      ';
      $this->email->message($message);
    }

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function verifikasi()
  {
    if (!$this->session->userdata('email')) {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger pesan">
        <div class="w-10">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
          </svg>
        </div>
        Akses Ditolak!
      </div>');
      redirect('autentifikasi');
    }

    $this->form_validation->set_rules('code', 'Kode Verifikasi', 'required|trim|numeric|min_length[4]', [
      'required'   => 'Kode Verifikasi tidak boleh kosong!',
      'numeric'    => 'Kode Verifikasi berupa angka',
      'min_length' => 'Kode Verifikasi terlalu pendek, mohon diisi sesuai dengan yang ada di email'
    ]);

    $data['judul'] = "Verfikasi Akun";
    $email = $this->session->userdata('email');
    $email = explode('@', $email);
    $hide = substr($email[0], 0, 3) . '***@' . $email[1];
    $data['email'] = $hide;

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/aute_header', $data);
      $this->load->view('autentifikasi/verifikasi');
      $this->load->view('templates/aute_footer');
    } else {
      $code = $this->input->post('code', true);

      $user = $this->db->get_where('token', ['email' => $this->session->userdata('email')])->row_array();

      if ($user['token'] == $code) {
        if (time() - $user['date_created'] < (60 * 60 * 24)) {
          $this->db->set('is_active', 1);
          $this->db->where('email', $this->session->userdata('email'));
          $this->db->update('user');

          $this->session->unset_userdata('email');
          $this->session->unset_userdata('type');
          $this->db->delete('token', ['token' => $user['token']]);

          $this->session->set_flashdata('pesan', '<div class="alert alert-primary pesan">Email ' . $data['email'] . ' berhasil diaktivasi</div>');
          redirect('autentifikasi');
        } else {
          $this->db->delete('user', ['email' => $user['email']]);
          $this->db->delete('token', ['token' => $user['token']]);
          $this->session->unset_userdata('email');
          $this->session->set_flashdata('pesan', '<div class="alert alert-danger pesan">Kode Verifikasi Kadaluarsa! Akun anda kami hapus</div>');
          redirect('Autentifikasi');
        }
      } else {
        if ($this->session->userdata('type') == 'registrasi') {
          $this->db->delete('user', ['email' => $user['email']]);
          $this->db->delete('token', ['token' => $user['token']]);
          $this->session->unset_userdata('email');
          $this->session->set_flashdata('pesan', '<div class="alert alert-danger pesan">Kode Verifikasi Salah! Akun anda kami hapus</div>');
          redirect('Autentifikasi');
        } else {
          $this->session->set_flashdata('pesan', '<div class="alert alert-danger pesan">Kode Verifikasi Salah! Mohon konfirmasi ulang email anda</div>');
          redirect('autentifikasi/lupaPassword');
        }
      }
    }
  }

  public function lupaPassword()
  {
    $data['judul'] = "Lupa Sandi";
    $this->load->view('templates/aute_header', $data);
    $this->load->view('autentifikasi/lupa-password');
    $this->load->view('templates/aute_footer');
  }

  public function logout()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');

    $this->session->set_flashdata('pesan', '<h1 class="alert alert-success pesan" role="alert">Anda telah logout!!</h1>');
    redirect('autentifikasi');
  }

  public function blok()
  {
    $this->load->view('autentifikasi/blok');
  }

  public function gagal()
  {
    $this->load->view('autentifikasi/gagal');
  }
}
