<div id="sidebar" class="active">
  <div class="sidebar-wrapper active">
    <div class="sidebar-header">
      <div class="d-flex justify-content-between">
        <div class="logo">
          <a href="<?= base_url('admin'); ?>">
            E-library
          </a>
        </div>
        <div class="toggler">
          <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
        </div>
      </div>
    </div>
    <div class="sidebar-menu">
      <ul class="menu">
        <li class="sidebar-item <?= cek_menu(1, 'admin'); ?>">
          <a href="<?= base_url('admin'); ?>" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="sidebar-title">Master Data</li>

        <li class="sidebar-item <?= cek_menu(2, 'kategori'); ?>">
          <a href="<?= base_url('buku/kategori'); ?>" class="sidebar-link">
            <i class="bi bi-book"></i>
            <span>Kategori Buku</span>
          </a>
        </li>

        <li class="sidebar-item <?php
                                if ($this->uri->segment(2) == 'kategori') {
                                  echo '';
                                } else if ($this->uri->segment(1) == 'buku') {
                                  echo 'active';
                                } else {
                                  echo '';
                                }
                                ?>">
          <a href="<?= base_url('buku'); ?>" class="sidebar-link">
            <i class="bi bi-book"></i>
            <span>Data Buku</span>
          </a>
        </li>

        <li class="sidebar-item <?= cek_menu(2, 'anggota'); ?>">
          <a href="<?= base_url('user/anggota'); ?>" class="sidebar-link">
            <i class="bi bi-people"></i>
            <span>Data Anggota</span>
          </a>
        </li>

        <li class="sidebar-title">Transaksi</li>

        <li class="sidebar-item <?php
                                if ($this->uri->segment(2) == 'daftarBooking') {
                                  echo '';
                                } else if ($this->uri->segment(1) == 'pinjam') {
                                  echo 'active';
                                } else {
                                  echo '';
                                }
                                ?>">
          <a href="<?= base_url('pinjam'); ?>" class="sidebar-link">
            <i class="bi bi-cart"></i>
            <span>Data Peminjam</span>
          </a>
        </li>

        <li class="sidebar-item <?= cek_menu(2, 'daftarBooking'); ?>">
          <a href="<?= base_url('pinjam/daftarBooking'); ?>" class="sidebar-link">
            <i class="bi bi-bag"></i>
            <span>Data Booking</span>
          </a>
        </li>

        <li class="sidebar-title">Laporan</li>

        <li class="sidebar-item <?= cek_menu(2, 'laporan_buku'); ?>">
          <a href="<?= base_url('laporan/laporan_buku'); ?>" class="sidebar-link">
            <i class="bi bi-card-checklist"></i>
            <span>Laporan Data Buku</span>
          </a>
        </li>

        <li class="sidebar-item <?= cek_menu(2, 'laporan_anggota'); ?>">
          <a href="<?= base_url('laporan/laporan_anggota'); ?>" class="sidebar-link">
            <i class="bi bi-card-checklist"></i>
            <span>Laporan Data Anggota</span>
          </a>
        </li>

        <li class="sidebar-item <?= cek_menu(2, 'laporan_pinjam'); ?>">
          <a href="<?= base_url('laporan/laporan_pinjam'); ?>" class="sidebar-link">
            <i class="bi bi-card-checklist"></i>
            <span>Laporan Data Peminjam</span>
          </a>
        </li>
      </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
  </div>
</div>