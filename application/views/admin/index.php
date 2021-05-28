<div id="main-content">
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Dashboard</h3>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <a href="#">
                    <div class="stats-icon purple">
                      <i class="iconly-boldProfile"></i>
                    </div>
                  </a>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Jumlah Anggota</h6>
                  <h6 class="font-extrabold mb-0">
                    <?= $this->ModelUser->getUserWhere(['role_id' => 1])->num_rows(); ?>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <a href="#">
                    <div class="stats-icon blue">
                      <i class="iconly-boldFolder"></i>
                    </div>
                  </a>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Stok Buku Terdaftar</h6>
                  <h6 class="font-extrabold mb-0">
                    <?php
                    $where = ['stok != 0'];
                    $totalstok = $this->ModelBuku->total('stok', $where);
                    echo $totalstok;
                    ?>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <a href="#">
                    <div class="stats-icon green">
                      <i class="iconly-boldBookmark"></i>
                    </div>
                  </a>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Buku yang dipinjam</h6>
                  <h6 class="font-extrabold mb-0">
                    <?php
                    $where = ['dipinjam != 0'];
                    $totaldipinjam = $this->ModelBuku->total(
                      'dipinjam',
                      $where
                    );
                    echo $totaldipinjam;
                    ?>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-3 py-4-5">
              <div class="row">
                <div class="col-md-4">
                  <a href="#">
                    <div class="stats-icon red">
                      <i class="iconly-boldArchive iconly-boldBag"></i>
                    </div>
                  </a>
                </div>
                <div class="col-md-8">
                  <h6 class="text-muted font-semibold">Buku yang dibooking</h6>
                  <h6 class="font-extrabold mb-0">
                    <?php
                    $where = ['dibooking != 0'];
                    $totaldibooking = $this->ModelBuku->total('dibooking', $where);
                    echo $totaldibooking;
                    ?>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Data User</h4>
            <a href="<?= base_url('user/anggota'); ?>" class="btn btn-primary btn-sm">Tampilkan</a>
          </div>
          <div class="card-body">
            <table class="table table-striped" id="table1">
              <thead>
                <tr>
                  <th>Nama Anggota</th>
                  <th>Email</th>
                  <th>Role Id</th>
                  <th>Aktif</th>
                  <th>Member Sejak</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($anggota as $a) : ?>
                  <tr>
                    <td><?= $a['nama']; ?></td>
                    <td><?= $a['email']; ?></td>
                    <td><?= $a['role_id']; ?></td>
                    <td>
                      <?= ($a['is_active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Non Active</span>' ?>

                    </td>
                    <td><?= date('Y', $a['tanggal_input']); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Data Buku</h4>
            <a href="<?= base_url('buku'); ?>" class="btn btn-primary btn-sm">Tampilkan</a>
          </div>
          <div class="card-body">
            <table class="table table-striped" id="table2">
              <thead>
                <tr>
                  <th>Judul Buku</th>
                  <th>Pengarang</th>
                  <th>Penerbit</th>
                  <th>Tahun Terbit</th>
                  <th>ISBN</th>
                  <th>Stok</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($buku as $b) : ?>
                  <tr>
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