<div id="main-content">
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Laporan Data Peminjam</h3>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Data Peminjam</h4>

            <div class="d-flex">
              <a href="<?= base_url('laporan/cetak_laporan_pinjam'); ?>" class="btn btn-primary d-flex align-items-center" title="Print">
                <i class="bi bi-printer"></i>
              </a>
              <a href="<?= base_url('laporan/laporan_pinjam_pdf'); ?>" class="btn btn-warning d-flex align-items-center mx-2" title="Download Pdf">
                <i class="bi bi-file-earmark"></i>
              </a>
              <a href="<?= base_url('laporan/export_excel_pinjam'); ?>" class="btn btn-secondary d-flex align-items-center" title="Download Excel">
                <i class="bi bi-file-excel"></i>
              </a>
            </div>
          </div>

          <div class="card-body">
            <table class="table table-striped" id="table1">
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
                    <td><?= date('d M Y', strtotime($l['tgl_pinjam'])); ?></td>
                    <td><?= date('d M Y', strtotime($l['tgl_kembali'])); ?></td>
                    <td>
                      <?php if ($l['status'] == 'Kembali') : ?>
                        <?= date('d M Y', strtotime($l['tgl_pengembalian'])); ?>
                      <?php else : ?>
                        Buku Masih Dipinjam
                      <?php endif; ?>
                    </td>
                    <td><?= $l['total_denda']; ?></td>
                    <td><?= $l['status_pinjam']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>