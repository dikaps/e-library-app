<style>
  body {
    font-family: 'Verdana', sans-serif;
  }

  table {
    border-collapse: collapse;
    width: 80%;
    margin: 0 auto;
  }

  tr,
  th,
  td {
    padding: 10px 5px;
  }
</style>

<body>
  <table border="1">
    <?php foreach ($useraktif as $u) : ?>
      <tr>
        <th>Nama Anggota : <?= $u->nama; ?></th>
      </tr>
      <tr>
        <th>Buku Yang dibooking:</th>
      </tr>
    <?php endforeach; ?>
    <tr>
      <td>
        <table>
          <tr>
            <th>No.</th>
            <th>Buku</th>
            <th>Penulis</th>
            <th>penerbit</th>
            <th>Tahun</th>
            <th>Tanggal Booking</th>
            <th>Batas Pengambilan</th>
          </tr>

          <?php $i = 1;
          foreach ($items as $item) : ?>
            <tr>
              <td><?= $i++; ?></td>
              <td>
                <?= $item['judul_buku']; ?>
              </td>
              <td><?= $item['pengarang']; ?></td>
              <td><?= $item['penerbit']; ?></td>
              <td><?= $item['tahun_terbit']; ?></td>
              <td><?= $item['tgl_booking']; ?></td>
              <td><?= $item['batas_ambil']; ?></td>
            </tr>

          <?php endforeach; ?>
        </table>
      </td>
    </tr>

    <!-- <tr>
    <td>
      <hr>
    </td>
  </tr> -->

    <tr>
      <td align="center">
        <?= md5(date('d M Y H:i:s')); ?>
      </td>
    </tr>
  </table>
</body>