<?php if ($this->session->flashdata('pesan')) : ?>
  <div id="pesan" data-pesan="<?= $this->session->flashdata('pesan'); ?>" data-rules="<?= $this->session->flashdata('rules'); ?>" class="hidden"></div>
<?php endif; ?>
<div id="main-content">
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last mb-3">
          <h3>Profile</h3>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Data Profile</h4>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col col-lg-3 d-flex flex-column justify-content-center">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="images" class="img-fluid rounded-3" />
                <button type="button" class="btn btn-secondary block mt-2" data-bs-toggle="modal" data-bs-target="#ubahFoto">Ubah Foto</button>
              </div>
              <div class="col-lg-9 col d-flex justify-content-center flex-column">
                <div>
                  <h4>Nama</h4>
                  <span><?= $user['nama']; ?></span>
                </div>

                <div class="my-2">
                  <h4>Kontak</h4>
                  <span>Email : <?= $user['email']; ?> | No Telp : <?= $user['no_telp']; ?></span>
                </div>

                <div>
                  <h4>Member Sejak</h4>
                  <strong><?= date('d F Y', $user['tanggal_input']); ?></strong>
                </div>

                <div>
                  <button type="button" class="btn btn-primary block mt-2" data-bs-toggle="modal" data-bs-target="#border-less" id="editProfile" data-id="<?= $user['id']; ?>">Edit Profile</button>
                  <button type="button" class="btn btn-danger block mt-2" data-bs-toggle="modal" data-bs-target="#ubahPassword" id="editProfile" data-id="<?= $user['id']; ?>">Ubah Password</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Profile </span><span class="text-danger text-sm">(*) wajib diisi</span></h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form action="#" method="POST" id="formUbahProfile">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama">Nama Lengkap <span class="text-danger text-sm">*</span></label>
              <input type="text" id="nama" class="form-control" placeholder="Nama Lengkap" name="nama" required />
            </div>

            <div class="form-group">
              <label for="email">Email <span class="text-danger text-sm">*</span></label>
              <input type="email" id="email" class="form-control" placeholder="Alamat email" name="email" readonly />
            </div>

            <div class="form-group">
              <label for="notel">No Telp. <span class="text-danger text-sm">*</span></label>
              <input type="number" name="notel" id="notel" class="form-control" placeholder="Nomer Telepon">
            </div>

            <div class="form-group">
              <label for="alamat">Alamat <span class="text-danger text-sm">*</span></label>
              <textarea name="alamat" id="alamat" class="form-control" required></textarea>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Tutup</span>
            </button>
            <button type="submit" class="btn btn-primary ml-1">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Ubah</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade text-left modal-borderless" id="ubahPassword" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Password </span><span class="text-danger text-sm">(*) wajib diisi</span></h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form action="<?= base_url('user/ubahPassword/' . $user['id']); ?>" method="POST" id="formUbahPassword">
          <div class="modal-body">
            <div class="form-group">
              <label for="old_password">Kata Sandi Lama <span class="text-danger text-sm">*</span></label>
              <input type="password" id="old_password" class="form-control" placeholder="Kata Sandi Sebelumnya" name="password_sekarang" required />
            </div>

            <div class="form-group">
              <label for="new_password">Kata Sandi Baru <span class="text-danger text-sm">*</span></label>
              <input type="password" id="new_password" class="form-control" placeholder="Password Baru" name="password_baru1" />
            </div>

            <div class="form-group">
              <label for="new_password2">Ulangi Kata Sandi Baru <span class="text-danger text-sm">*</span></label>
              <input type="password" id="new_password2" class="form-control" placeholder="Password Baru" name="password_baru2" />
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Tutup</span>
            </button>
            <button type="submit" class="btn btn-primary ml-1">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Ubah</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade text-left modal-borderless" id="ubahFoto" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Foto</h5>
          <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form action="<?= base_url('user/ubahfoto/' . $user['id']); ?>" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="d-flex justify-content-center">
              <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="images" id="image" class="img-fluid w-50 rounded-circle" />
            </div>
            <div class="form-group">
              <input type="file" class="form-control mt-3" name="image" onchange="loadFile(event)" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Tutup</span>
            </button>
            <button type="submit" class="btn btn-primary ml-1">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Ubah</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>