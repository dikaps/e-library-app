<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>
<style type="text/css">
  .table-data {
    width: 100%;
    border-collapse: collapse;
  }

  .table-data th {
    text-align: left;
  }

  .table-data tr th,
  .table-data tr td {
    /* border: 1px solid #00000050; */
    border-bottom: 1px solid #00000050;
    font-size: 11pt;
    font-family: Verdana;
    padding: 10px 10px 10px 10px;
  }

  h3 {
    font-family: Verdana;
  }
</style>

<body>
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
  <script type="text/javascript">
    window.print();
    window.onafterprint = function(event) {
      document.location.href = "<?= base_url('laporan/laporan_anggota'); ?>";
    };
  </script>
</body>

</html>