<div class="container">
  <div class="row justify-content-center">
    <table>
      <?php foreach ($useraktif as $u) : ?>
        <tr>
          <td nowrap>Terima Kasih <b><?= $u->nama; ?></b>
          </td>
        </tr>

        <tr>
          <td>Buku Yang ingin Anda Pinjam Adalah Sebagai berikut:</td>
        </tr>
      <?php endforeach; ?>

      <tr>
        <td>
          <div class="table-responsive">
            <table class="table table-bordered table-striped tablehover" id="table-datatable">
              <tr>
                <th>No.</th>
                <th>Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Tanggal Booking</th>
                <th>Batas Pengambilan</th>
              </tr>

              <?php $i = 1;
              foreach ($items as $item) : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td>
                    <img src="<?= base_url('assets/img/upload/' . $item['image']); ?>" class="rounded img-fluid w-25" alt="No Picture">
                  </td>

                  <td nowrap><?= $item['pengarang']; ?></td>
                  <td nowrap><?= $item['penerbit']; ?></td>
                  <td nowrap><?= $item['tahun_terbit']; ?></td>
                  <td nowrap><?= $item['tgl_booking']; ?></td>
                  <td nowrap><?= $item['batas_ambil']; ?></td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <hr>
        </td>
      </tr>

      <tr>
        <td>
          <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Waktu Pengambilan Buku 1x24 jam dari Booking!!!');" href="<?= base_url() . 'booking/exportToPdf/' . $this->session->userdata('id_user'); ?>"><span class="far fa-lg fa-fw fa-file-pdf"></span> Pdf</a>
        </td>
      </tr>

    </table>
  </div>
</div>