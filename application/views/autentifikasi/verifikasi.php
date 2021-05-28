<div class="grid xl:grid-cols-3 grid-cols-1 h-screen">
  <div class="bg-gray-500 overflow-hidden col-span-1 xl:block hidden">
    <img src="<?= base_url('assets/user/'); ?>img/login-forgot.jpg" alt="image" />
  </div>
  <div class="lg:col-span-2 flex items-center justify-center relative">
    <div class="xl:w-1/2 sm:w-4/5 lg:w-1/2 w-4/5 flex flex-col">
      <h2 class="text-2xl font-semibold mb-7 text-secondary-100">Verifikasi Akun</h2>
      <span class="font-light text-gray-500"> Kode verifikasi telah kami kirim ke email <em class="font-semibold"><?= $email; ?></em></span>

      <form action="<?= base_url('autentifikasi/verifikasi'); ?>" method="POST">
        <div class="text-secondary-100 flex flex-col my-5">
          <label for="code" class="font-semibold mb-3">Kode Verifikasi </label>
          <input type="number" name="code" id="code" class="bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" placeholder="cth: 4526" maxlength="4" required />
          <?= form_error('code', '<span style="color:#d9534f;">', '</span>'); ?>
        </div>

        <button type="submit" class="bg-warning-200 px-20 text-white py-3 rounded xl:w-auto w-full hover:bg-yellow-500">
          Verifikasi
        </button>
      </form>
    </div>
  </div>
</div>