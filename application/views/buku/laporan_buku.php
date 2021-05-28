<div id="main-content">
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Laporan Data Buku</h3>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Data buku</h4>

            <div class="d-flex">
              <a href="<?= base_url('laporan/cetak_laporan_buku'); ?>" class="btn btn-primary d-flex align-items-center" title="Print">
                <i class="bi bi-printer"></i>
              </a>
              <a href="<?= base_url('laporan/laporan_buku_pdf'); ?>" class="btn btn-warning d-flex align-items-center mx-2" title="Download Pdf">
                <i class="bi bi-file-earmark"></i>
              </a>
              <a href="<?= base_url('laporan/export_excel'); ?>" class="btn btn-secondary d-flex align-items-center" title="Download Excel">
                <i class="bi bi-file-excel"></i>
              </a>
            </div>
          </div>

          <div class="card-body">
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Judul</th>
                  <th>Pengarang</th>
                  <th>Penerbit</th>
                  <th>Tahun Terbit</th>
                  <th>ISBN</th>
                  <th>Stok</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($buku as $b) : ?>
                  <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $b['judul_buku']; ?></td>
                    <td><?= $b['pengarang']; ?></td>
                    <td><?= $b['penerbit']; ?></td>
                    <td><?= $b['tahun_terbit']; ?></td>
                    <td><?= $b['isbn']; ?></td>
                    <td><?= $b['stok']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>