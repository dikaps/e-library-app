<div id="main-content">
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Data Booking</h3>

          <?php if (validation_errors()) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
              <?= validation_errors(); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Daftar Booking buku</h4>
          </div>

          <div class="card-body">
            <table class="table table-striped table" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Booking</th>
                  <th>Tanggal Booking</th>
                  <th>Nama Peminjam</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($pinjam as $p) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td>
                      <a href="<?= base_url('pinjam/bookingDetail/' . $p['id_booking']); ?>" class="btn btn-primary btnBookingDetail" data-id="<?= $p['id_booking']; ?>" data-bs-toggle="modal" data-bs-target="#border-less">
                        <?= $p['id_booking']; ?>
                      </a>

                    </td>
                    <td><?= date('d M Y', strtotime($p['tgl_booking'])); ?></td>
                    <td><?= $p['nama']; ?></td>


                    <td nowrap>
                      <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center btnKonfirmasi" title="Konfirmasi Peminjaman" data-bs-toggle="modal" data-bs-target="#konfirmasi" data-id="<?= $p['id_booking']; ?>">
                        <i class="bi bi-cart-check"></i>
                      </button>
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
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Booking </h5>
          <button type="button" class="close rounded" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="nama_peminjam">Nama Peminjam </label>
                <input type="text" id="nama_peminjam" name="nama_peminjam" class="form-control" value readonly />
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="id_booking">ID Booking </label>
                <input type="text" id="id_booking" class="form-control" name="idBooking" value readonly />
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-lg">
              <thead>
                <tr>
                  <th>Judul Buku</th>
                  <th>Pengarang</th>
                  <th>Penerbit</th>
                  <th>Tahun Terbit</th>
                </tr>
              </thead>

              <tbody class="data">
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Tutup</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade text-left modal-borderless" id="konfirmasi" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Peminjaman : <span class="namaPeminjam text-danger"></span></h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form method="POST" class="konfirmasiPinjam">
          <div class="modal-body">
            <div class="form-group">
              <label for="denda">Denda / Buku / Hari</label>
              <input type="text" id="denda" name="denda" class="form-control" value="5000" required />
            </div>

            <div class="form-group">
              <label for="lama">Lama Pinjam</label>
              <input type="text" id="lama" name="lama" class="form-control" required />
            </div>
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