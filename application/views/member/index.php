<section class="sec">
  <div class="flex items-center">
    <a href="<?= base_url(); ?>" class="w-10 h-10 rounded-full bg-white shadow-2xl flex justify-center items-center hover:shadow transition-shadow">
      <svg xmlns="http://www.w3.org/2000/svg" width="8.164" height="17.328" viewBox="0 0 10.164 18.328">
        <path id="Path_11" data-name="Path 11" d="M12.75,20.5,5,12.75,12.75,5" transform="translate(-4 -3.586)" fill="none" stroke="#1B1C1E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
      </svg>
    </a>
    <h1 class="text-2xl font-bold ml-5 text-secondary-100">Profile</h1>

  </div>
  <div class="sm:px-10 sm:py-14 p-10 rounded-lg shadow-md bg-white mt-5">

    <div class="flex w-full justify-center xl:items-start items-center mr-5 lg:flex-row flex-col">
      <div class="sm:w-56 flex flex-col items-center w-full lg:mr-10 lg:mb-0 mb-10">
        <img src="<?= base_url('assets/img/profile/' . $image); ?>" alt="avatar" class="w-32 mb-3 rounded-full" />
        <a href="<?= base_url('member/ubahProfil'); ?>" class="py-2 px-6 text-white transition-all rounded text-sm shadow-md bg-primary hover:bg-blue-600 bg-primary-200">Ubah Profile</a>
      </div>
      <!-- desc -->
      <div class="text-secondary-600 h-44 flex flex-col justify-center">
        <h2 class="font-bold sm:text-2xl text-sm text-center lg:text-left"><?= $user; ?></h2>
        <div class="flex my-5 sm:flex-row flex-col">
          <!-- email -->
          <div class="flex text-sm items-center sm:mr-5">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#A6A8AA67" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
              <polyline points="22,6 12,13 2,6"></polyline>
            </svg>
            <span class="ml-3 text-xs sm:text-sm font-light"> <?= $email; ?> </span>
          </div>
        </div>

        <div class="flex items-center lg:justify-start justify-center text-secondary-200 sm:flex-row flex-col">
          <span class="text-sm" style="color: #a6a8aa67">Member Since <?= date('d M Y', $tanggal_input) ?></span>
        </div>
        <?= $this->session->userdata('pesan'); ?>
      </div>
    </div>

    <div class="sm:mt-20">
      <h1 class="font-semibold text-lg">Riwayat Peminjaman Buku</h1>

      <div class="w-full grid sm:grid-cols-2 grid-cols-1 gap-5 mt-5">
        <?php if (count($riwayat) < 1) : ?>
          <div class="card-buku">
            <p class="sm:mb-0 mb-3">
              Belum ada riwayat peminjaman Buku
            </p>
          </div>
        <?php else : ?>
          <?php foreach ($riwayat as $r) : ?>
            <div class="card-buku">
              <p class="judul sm:mb-0 mb-3" title="<?= $r['judul_buku']; ?>">
                <?= $r['judul_buku']; ?>
              </p>

              <a href="<?= base_url('booking/riwayatPinjam/' . $r['id_buku']); ?>" class="btn-buku detail">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="16" x2="12" y2="12"></line>
                  <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                Detail
              </a>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>