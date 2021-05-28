<section class="sm:my-10 w-4/5 mx-auto py-10">

  <div class="flex flex-col sm:flex-row">
    <div class="sm:w-80 order-2 sm:order-2">
      <img src="<?= base_url('assets/img/upload/' . $gambar); ?>" class="shadow-md rounded mb-5 sm:mb-0" alt="buku" />
    </div>

    <div class="w-full sm:mx-10 order-1 sm:order-2 mb-5 sm:mb-0">
      <h1 class="text-lg sm:text-2xl font-semibold mb-3"><?= $judul; ?></h1>
      <p><?= $pengarang; ?></p>
    </div>

    <div class="sm:w-1/3 order-3">
      <a href="#" class="btn-buku booking">
        <svg class="mr-2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <path d="M16 10a4 4 0 0 1-8 0"></path>
        </svg>

        Booking
      </a>

      <a href="" class="btn-buku bg-gray-400 mt-3 text-center" id="wishlist">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
          <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
        </svg>
        Wishlist
      </a>
    </div>
  </div>

  <div class="w-full mt-10">
    <h1 class="text-xl font-medium">Detail</h1>

    <div class="mt-5">
      <dl>
        <dt class="flex sm:flex-row flex-col">
          <div class="sm:w-80 w-full">
            <p class="">Jumlah Halaman</p>
          </div>
          <p class="font-semibold">568</p>
        </dt>
      </dl>

      <dl>
        <dt class="flex sm:flex-row flex-col">
          <div class="sm:w-80 w-full">
            <p class="">Penerbit</p>
          </div>
          <p class="font-semibold">
            <a href="#" class="hover:underline transition-all"><?= $penerbit; ?></a>
          </p>
        </dt>
      </dl>

      <dl>
        <dt class="flex sm:flex-row flex-col">
          <div class="sm:w-80 w-full">
            <p class="">Tahun Terbit</p>
          </div>
          <p class="font-semibold"><?= $tahun; ?></p>
        </dt>
      </dl>

      <dl>
        <dt class="flex sm:flex-row flex-col">
          <div class="sm:w-80 w-full">
            <p class="">ISBN</p>
          </div>
          <p class="font-semibold"><?= $isbn; ?></p>
        </dt>
      </dl>

      <dl>
        <dt class="flex sm:flex-row flex-col">
          <div class="sm:w-80 w-full">
            <p class="">Kategori</p>
          </div>
          <p class="font-semibold">
            <a href="#" class="hover:underline transition-all"><?= $kategori; ?></a>
          </p>
        </dt>
      </dl>

      <dl>
        <dt class="flex sm:flex-row flex-col">
          <div class="sm:w-80 w-full">
            <p class="">Stok</p>
          </div>
          <p class="font-semibold"><?= $stok ?></p>
        </dt>
      </dl>
    </div>
  </div>
</section>