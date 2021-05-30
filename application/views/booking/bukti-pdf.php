<style>
  .anggota h3 {
    font-weight: 600;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  table th {
    text-align: left;
  }

  table th,
  table td {
    border-bottom: 1px solid #00000050;
    font-size: 11pt;
    padding: 10px;
  }
</style>

<body>
  <div class="anggota">
    <h3>Nama Anggota</h3>
    <p><?= $useraktif['nama']; ?></p>
  </div>

  <p>Buku yang di booking : </p>
  <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>Buku</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Tahun</th>
        <th nowrap>Tanggal Booking</th>
        <th nowrap>Batas Pengambilan</th>
      </tr>
    </thead>

    <tbody>
      <?php $i = 1;
      foreach ($items as $item) : ?>
        <tr>
          <td nowrap><?= $i++; ?></td>
          <td nowrap><?= $item['judul_buku']; ?></td>
          <td nowrap><?= $item['pengarang']; ?></td>
          <td nowrap><?= $item['penerbit']; ?></td>
          <td nowrap><?= $item['tahun_terbit']; ?></td>
          <td><?= date("d M Y", strtotime($item['tgl_booking'])); ?></td>
          <td><?= date("d M Y", strtotime($item['batas_ambil'])); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <p style="text-align: center;">
    <?= md5(date('d M Y H:i:s')); ?>
  </p>
</body>