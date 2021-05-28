<section class="sec">
  <div class="flex items-center">
    <a href="<?= base_url('member/myprofil'); ?>" class="w-10 h-10 rounded-full bg-white shadow-2xl flex justify-center items-center hover:shadow transition-shadow">
      <svg xmlns="http://www.w3.org/2000/svg" width="8.164" height="17.328" viewBox="0 0 10.164 18.328">
        <path id="Path_11" data-name="Path 11" d="M12.75,20.5,5,12.75,12.75,5" transform="translate(-4 -3.586)" fill="none" stroke="#1B1C1E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
      </svg>
    </a>
    <h1 class="text-2xl font-bold ml-5 text-secondary-100">Ubah Profile</h1>
  </div>
  <div class="sm:px-10 sm:py-14 p-10 rounded-lg shadow-md bg-white mt-5">
    <form action="<?= base_url('member/ubahProfil'); ?>" method="POST" enctype="multipart/form-data">
      <div class="flex flex-col">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" class="w-full border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100 mt-3" value="<?= $user; ?>" required />
      </div>

      <div class="flex flex-col my-5">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="w-full border-2 border-transparent bg-gray-300 outline-none rounded-md px-4 py-2 text-secondary-100 mt-3" value="<?= $email; ?>" readonly />
      </div>

      <div class="flex flex-col my-5">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" class="w-full border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100 mt-3" required><?= $alamat; ?></textarea>
      </div>

      <div class="flex flex-col">
        <label for="no_telp">No Telp</label>
        <input type="number" name="no_telp" id="no_telp" class="w-full border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100 mt-3" value="<?= $no_telp; ?>" required />
      </div>

      <div class="flex w-full flex-col sm:flex-row mt-5">
        <div class="flex flex-col w-full lg:w-1/2">
          <label for="image">Foto Profile</label>
          <input type="file" name="image" id="image" class="mt-3" onchange="loadFile(event)" />
        </div>
        <img src="<?= base_url('assets/img/profile/' . $image); ?>" alt="avatar" class="w-32 mt-3 sm:mt-0 rounded-full" id="img" />
      </div>
      <button type="submit" class="px-6 py-2 mt-5 rounded text-white booking">Update</button>
    </form>
  </div>
</section>