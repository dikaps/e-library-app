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
    <center>Laporan Data Peminjaman Buku</center>
  </h3>
  <br />
  <table class="table-data">
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
  <script type="text/javascript">
    window.print();
    window.onafterprint = function(event) {
      document.location.href = "<?= base_url('laporan/laporan_pinjam'); ?>";
    };
  </script>
</body>

</html>