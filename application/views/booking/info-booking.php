<section class="sm:my-10 w-4/5 mx-auto py-10">
  <div class="flex items-center">
    <a href="<?= base_url(); ?>" class="w-10 h-10 rounded-full bg-white shadow-2xl flex justify-center items-center hover:shadow transition-shadow">
      <svg width="8.164" height="17.328" viewBox="0 0 10.164 18.328">
        <path id="Path_11" data-name="Path 11" d="M12.75,20.5,5,12.75,12.75,5" transform="translate(-4 -3.586)" fill="none" stroke="#1B1C1E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
      </svg>
    </a>
    <h1 class="text-2xl font-bold ml-5 text-secondary-100">Daftar Buku yang Anda Pinjam</h1>
  </div>

  <div class="w-full overflow-x-auto">
    <table class="table-auto w-full my-5">
      <thead>
        <tr class="text-left">
          <th class="p-2">#</th>
          <th class="p-2">Buku</th>
          <th class="p-2">Penulis</th>
          <th class="p-2">Penerbit</th>
          <th class="p-2">Tahun Terbit</th>
          <th class="p-2">Tanggal Booking</th>
          <th class="p-2">Batas Pengembalian</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;
        foreach ($items as $item) : ?>
          <tr>
            <td class="p-2"><?= $i++; ?></td>
            <td class="w-28 p-2">
              <img src="<?= base_url('assets/img/upload/' . $item['image']); ?>" alt="No Picture" class="shadow-lg" />
            </td>
            <td class="p-2"><?= $item['pengarang']; ?></td>
            <td class="p-2"><?= $item['penerbit']; ?></td>
            <td class="p-2"><?= $item['tahun_terbit']; ?></td>
            <td class="p-2"><?= date("d M Y", strtotime($item['tgl_booking'])); ?></td>
            <td class="p-2"><?= date("d M Y", strtotime($item['batas_ambil'])); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="mt-10 flex">
    <a href="<?= base_url() . 'booking/exportToPdf/' . $this->session->userdata('id_user'); ?>" class="px-6 py-2 booking flex justify-center items-center rounded text-white mr-5" target="_blank">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
        <polyline points="13 2 13 9 20 9"></polyline>
      </svg>
      Pdf
    </a>
  </div>
</section>