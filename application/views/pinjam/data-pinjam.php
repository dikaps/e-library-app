<?php if ($this->session->flashdata('pesan')) : ?>
  <div id="pesan" data-pesan="<?= $this->session->flashdata('pesan'); ?>" data-rules="<?= $this->session->flashdata('rules'); ?>" class="hidden"></div>
<?php endif; ?>
<div id="main-content">
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Data Peminjam</h3>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Daftar Peminjam</h4>
          </div>

          <div class="card-body">
            <table class="table table-striped table" id="table1">
              <thead>
                <tr>
                  <th>No Pinjam</th>
                  <th nowrap>Tanggal Pinjam</th>
                  <th nowrap>ID User</th>
                  <th nowrap>Buku yang dipinjam</th>
                  <th nowrap>Tanggal Kembali</th>
                  <th nowrap>Tanggal Pengembalian</th>
                  <th nowrap>Terlambat</th>
                  <th nowrap>Denda /Hari</th>
                  <th nowrap>Status</th>
                  <th nowrap>Total Denda</th>
                  <th nowrap>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pinjam as $p) : ?>
                  <tr>
                    <td><?= $p['no_pinjam']; ?></td>
                    <td><?= date('d M Y', strtotime($p['tgl_pinjam'])); ?></td>
                    <td><?= $p['id_user']; ?></td>
                    <td><?= $p['judul_buku']; ?></td>
                    <td><?= date('d M Y', strtotime($p['tgl_kembali'])); ?></td>

                    <td>
                      <?= ($p['tgl_pengembalian'] == '0000-00-00') ? "Buku Masih dipinjam" : $p['tgl_pengembalian']; ?>
                    </td>
                    <td>
                      <?php
                      $tgl1 = new DateTime($p['tgl_kembali']);
                      $tgl2 = new DateTime();
                      $selisih = $tgl2->diff($tgl1)->format("%a");

                      if ($p['status'] == 'Kembali') {
                        $tglKembali = new DateTime($p['tgl_pengembalian']);
                        $selisihPengembalian = $tglKembali->diff($tgl1)->format("%a");
                        $beda = ($tglKembali < $tgl1) ? '0' : $selisihPengembalian;
                        echo $beda;
                      } else {
                        if ($tgl2 > $tgl1) {
                          echo $selisih;
                        } else {
                          echo 0;
                        }
                      }

                      ?> Hari
                    </td>
                    <td nowrap>Rp. <?= rupiah($p['denda']); ?></td>
                    <td>
                      <?= $p['status']; ?>
                    </td>
                    <?php
                    if ($tgl2 > $tgl1) {
                      $total_denda = $p['denda'] * $selisih;
                    } else {
                      $total_denda = $p['denda'] * 0;
                    }
                    ?>
                    <td>
                      <?php if ($p['status'] == 'Kembali') : ?>
                        Rp. <?= $p['total_denda']; ?>
                      <?php else : ?>
                        Rp. <?= rupiah($total_denda); ?>
                      <?php endif; ?>
                    </td>

                    <td nowrap>
                      <?php if ($p['status'] == "Kembali") : ?>
                        <button class="btn btn-sm btn-primary d-flex align-items-center" title="" id="edit"><i class="bi bi-check"></i></button>
                      <?php else : ?>
                        <button type="button" class="btn btn-sm btn-info btnStatus" data-bs-toggle="modal" data-bs-target="#border-less" data-idbuku="<?= $p['id_buku']; ?>" data-nopinjam="<?= $p['no_pinjam']; ?>">
                          Ubah Status
                        </button>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Ubah Status</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form method="POST" action="" class="konfirmasiStatusform">
          <div class="modal-body">
            <input type="text" class="form-control" name="total_denda" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Tutup</span>
            </button>
            <button type="submit" class="btn btn-primary ml-1">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block" id="btn">Konfirmasi</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>