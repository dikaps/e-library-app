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
<table class="table-data">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Email</th>
      <th>No Telp</th>
      <th>Alamat</th>
      <th>Member Sejak</th>
    </tr>
  </thead>

  <tbody>
  <tbody>
    <?php
    $no = 1;
    foreach ($anggota as $a) :
    ?>
      <tr>
        <th scope="row"><?= $no++; ?></th>
        <td><?= $a['nama']; ?></td>
        <td><?= $a['email']; ?></td>
        <td><?= $a['no_telp']; ?></td>
        <td><?= $a['alamat']; ?></td>
        <td><?= date("d M Y", $a['tanggal_input']); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>