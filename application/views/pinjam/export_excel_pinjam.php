<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<h3>
  <center>Laporan Data Buku Perputakaan Online</center>
</h3>
<br />
<table border="1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Anggota</th>
      <th scope="col">Judul Buku</th>
      <th scope="col">Tanggal Pinjam</th>
      <th scope="col">Tanggal Kembali</th>
      <th scope="col">Tanggal Dikembalikan</th>
      <th scope="col">Total Denda</th>
      <th scope="col">Status</th>
    </tr>
  </thead>

  <tbody>
    <?php $i = 1;
    foreach ($laporan as $l) : ?>
      <tr>
        <th scope="row"><?= $i++; ?></th>
        <td><?= $l['nama']; ?></td>
        <td><?= $l['judul_buku']; ?></td>
        <td><?= $l['tgl_pinjam']; ?></td>
        <td><?= $l['tgl_kembali']; ?></td>
        <td><?= $l['tgl_pengembalian']; ?></td>
        <td><?= $l['total_denda']; ?></td>
        <td><?= $l['status']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>