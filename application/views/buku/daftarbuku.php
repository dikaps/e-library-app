<section class="sec rounded-md shadow-lg grid place-items-center" style="background-color: #ffffff; background-image: linear-gradient(315deg, #ffffff 0%, #e3e8ee 74%)">
  <div class="w-2/3 flex items-center justify-center sm:flex-row flex-col">
    <div class="h-full w-52 bg-gray-500 rounded-md overflow-hidden shadow-lg mr-5 mb-5 sm:mb-0">
      <img src="<?= base_url('assets/img/upload/' . $upstok['image']); ?>" alt="buku" />
    </div>

    <div class="flex flex-col text-secondary-100">
      <h2 class="font-semibold lg:text-2xl"><?= $upstok['judul_buku']; ?></h2>
      <div class="my-5">
        <a href="#" class="py-2 px-4 rounded-md text-white bg-warning-200 hover:bg-yellow-500 transition-colors ease-linear"><?= $upstok['kategori']; ?></a>
      </div>
      <span> <?= $upstok['penerbit']; ?></span>
    </div>
  </div>
</section>

<section class="sec text-secondary-100">
  <form action="#" method="POST" autocomplete="off">
    <input type="text" name="nama" id="nama" class="w-full bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" placeholder="Cari Buku / Penulis / Penerbit / Kategori ..." />
  </form>

  <h1 class="font-semibold text-2xl mt-5">Daftar Buku</h1>

  <div class="w-full flex flex-wrap sm:flex-row flex-col my-5" id="buku">
  </div>

  <div class="w-full flex justify-center my-20">
    <button class="px-6 py-3 bg-warning-200 hover:bg-yellow-500 rounded text-white shadow-lg" id="load">Show More</button>
  </div>
</section>