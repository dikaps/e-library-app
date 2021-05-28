<div class="grid xl:grid-cols-3 grid-cols-1 h-screen">
  <div class="bg-gray-500 overflow-hidden col-span-1 xl:block hidden">
    <img src="<?= base_url('assets/user/'); ?>/img/login-forgot.jpg" alt="image" />
  </div>
  <div class="lg:col-span-2 flex items-center justify-center relative">
    <div class="xl:w-1/2 sm:w-4/5 lg:w-1/2 w-4/5 flex flex-col">
      <h2 class="text-2xl font-semibold mb-7 text-secondary-100">Masuk ke E-Library</h2>

      <?= $this->session->flashdata('pesan'); ?>



      <form method="POST">
        <div class="text-secondary-100 flex flex-col my-5">
          <label for="email" class="font-semibold mb-3">Email</label>
          <input type="email" name="email" id="email" class="bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" autofocus />
          <?= form_error('email', '<span style="color:#d9534f;">', '</span>'); ?>
        </div>

        <div class="text-secondary-100 flex flex-col my-5">
          <div class="flex justify-between">
            <label for="password" class="font-semibold mb-3">Kata Sandi</label>

            <a href="<?= base_url('autentifikasi/'); ?>lupaPassword" class="font-light text-primary-200">Lupa Sandi?</a>
          </div>
          <input type="password" name="password" id="password" class="bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" />
          <?= form_error('password', '<span style="color:#d9534f;">', '</span>'); ?>
        </div>

        <button type="submit" class="bg-warning-200 px-20 text-white py-3 rounded xl:w-auto w-full hover:bg-yellow-500">Masuk</button>
      </form>
      <span class="lg:absolute text-center my-3 xl:my-0 top-10 right-40 text-secondary-100">Belum punya akun? <a href="<?= base_url('autentifikasi/registrasi'); ?>" class="text-primary-200">Daftar</a>.</span>
    </div>
  </div>
</div>