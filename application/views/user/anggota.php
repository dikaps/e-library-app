<?php if ($this->session->flashdata('pesan')) : ?>
	<div id="pesan" data-pesan="<?= $this->session->flashdata('pesan'); ?>" data-rules="<?= $this->session->flashdata('rules'); ?>" class="hidden"></div>
<?php endif; ?>
<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last mb-3">
					<h3>Anggota</h3>

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
					<div class="card-header d-flex justify-content-between">
						<h4>Data Anggota</h4>
						<button type="button" class="btn btn-outline-primary block tambahAnggota" data-bs-toggle="modal" data-bs-target="#border-less">Tambah Anggota</button>
					</div>

					<div class="card-body">
						<table class="table table-striped" id="table1">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Email</th>
									<th>No Telp</th>
									<th>Member Sejak</th>
									<th>Image</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($anggota as $ag) : ?>
									<tr>
										<td><?= $i++; ?></td>
										<td><?= $ag['nama']; ?></td>
										<td><?= $ag['email']; ?></td>
										<td><?= $ag['no_telp']; ?></td>
										<td><?= date('d M Y', $ag['tanggal_input']); ?></td>
										<td>
											<img src="<?= base_url('assets/img/profile/' . $ag['image']); ?>" alt="" class="img-fluid rounded" style="width: 100px" />
										</td>
										<td>
											<div class="d-flex flex-column">
												<button class="btn btn-sm btn-outline-primary my-3 ubahAnggota" data-id="<?= $ag['id']; ?>" data-bs-toggle="modal" data-bs-target="#border-less">Ubah</button>
												<button class="btn btn-sm btn-outline-danger hapusAnggota" data-bs-toggle="modal" data-bs-target="#hapusAnggota" data-id="<?= $ag['id']; ?>">Hapus</button>
											</div>
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
					<h5 class="modal-title"><span class="title-modal-anggota">Tambah Anggota </span><span class="text-danger text-sm">(*) wajib diisi</span></h5>
					<button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
						<i data-feather="x"></i>
					</button>
				</div>
				<form action="<?= base_url('user/anggota'); ?>" method="POST" class="formAnggota">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="nama">Nama Anggota <span class="text-danger text-sm">*</span></label>
									<input type="text" id="nama" class="form-control" placeholder="Nama Anggota" name="nama" required />
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="email">Email <span class="text-danger text-sm">*</span></label>
									<input type="email" id="email" class="form-control" placeholder="Alamat email" name="email" required />
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="notel">No Telp. <span class="text-danger text-sm">*</span></label>
									<input type="number" name="notel" id="notel" class="form-control" placeholder="Nomer Telepon">
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="alamat">Alamat <span class="text-danger text-sm">*</span></label>
									<textarea name="alamat" id="alamat" class="form-control" required></textarea>
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="password">Password <span class="text-danger text-sm">*</span></label>
									<input type="password" id="password" class="form-control" name="password" placeholder="password" required />
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="password2">Ulangi Password <span class="text-danger text-sm">*</span></label>
									<input type="password" id="password2" class="form-control" name="password2" placeholder="Ulangi password" required />
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
							<i class="bx bx-x d-block d-sm-none"></i>
							<span class="d-none d-sm-block">Tutup</span>
						</button>
						<button type="submit" class="btn btn-primary ml-1">
							<i class="bx bx-check d-block d-sm-none"></i>
							<span class="d-none d-sm-block btn-tambah">Tambah</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade text-left modal-borderless" id="hapusAnggota" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-light">Apakah Anda Yakin ingin menghapus anggota <span class="namaAnggota text-danger"></span></h5>
					<button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
						<i data-feather="x"></i>
					</button>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
						<i class="bx bx-x d-block d-sm-none"></i>
						<span class="d-none d-sm-block">Tutup</span>
					</button>
					<a href="" class="btn btn-danger ml-1 linkHapus">
						<i class="bx bx-check d-block d-sm-none"></i>
						<span class="d-none d-sm-block">Hapus</span>
					</a>
				</div>
			</div>
		</div>
	</div>