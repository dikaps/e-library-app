<?php
$booking = $this->ModelBooking->getDataWhere('booking', ['id_user' => $this->session->userdata('id_user')])->num_rows();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $judul; ?> - E-library</title>
  <link rel="stylesheet" href="<?= base_url('assets/user/css/'); ?>tailwind.css" />
</head>

<body class="font-body bg-secondary-300">
  <!-- navbar -->
  <nav class="w-4/5 mx-auto flex justify-between py-10 text-secondary-100">
    <a href="#" class="font-semibold sm:text-xl text-lg">E-Library</a>
    <div class="flex relative items-center">
      <span class="text-xs sm:text-lg"><?= $user; ?></span>

      <button class="cursor-pointer sm:ml-5 ml-1" id="nav">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1B1C1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
      </button>

      <div class="w-56 absolute bg-white sm:-right-10 -right-7 top-10 sm:top-12 rounded-sm py-3 shadow-lg hidden transition ease-in" id="dropdown">
        <div class="flex flex-col">
          <?php if ($this->session->userdata('email')) : ?>
            <a href="./src/pages/auth/login.html" class="py-3 px-6 flex text-sm hover:bg-secondary-200">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1B1C1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              Profile Saya
            </a>

            <a href="./src/pages/auth/daftar.html" class="py-3 px-6 flex text-sm hover:bg-secondary-200">
              <svg class="mr-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1B1C1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10a4 4 0 0 1-8 0"></path>
              </svg>
              Booking &nbsp;<strong><?= $this->ModelBooking->getDataWhere('temp', ['email_user' => $this->session->userdata('email')])->num_rows(); ?></strong>&nbsp; Buku
            </a>

            <a href="./src/pages/auth/daftar.html" class="py-3 px-6 flex text-sm hover:bg-secondary-200 <?= ($booking > 0) ?: 'hidden'; ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1B1C1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
              </svg>
              Info Booking
            </a>

            <a href="<?= base_url('member/logout'); ?>" class="py-3 px-6 flex text-sm hover:bg-secondary-200">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1B1C1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg>
              Log out
            </a>
          <?php else : ?>
            <a href="<?= base_url('autentifikasi'); ?>" class="py-3 px-6 flex text-sm hover:bg-secondary-200">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1B1C1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                <polyline points="10 17 15 12 10 7"></polyline>
                <line x1="15" y1="12" x2="3" y2="12"></line>
              </svg>
              Masuk
            </a>

            <a href="<?= base_url('autentifikasi/registrasi'); ?>" class="py-3 px-6 flex text-sm hover:bg-secondary-200">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1B1C1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="8.5" cy="7" r="4"></circle>
                <line x1="20" y1="8" x2="20" y2="14"></line>
                <line x1="23" y1="11" x2="17" y2="11"></line>
              </svg>
              Daftar
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
  <!-- /navbar -->