<?php if ($this->session->flashdata('pesan')) : ?>
	<div id="pesan" data-pesan="<?= $this->session->flashdata('pesan'); ?>" data-rules="<?= $this->session->flashdata('rules'); ?>" class="hidden"></div>
<?php endif; ?>
<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last mb-3">
					<h3>Buku</h3>

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
						<h4>Data Buku</h4>
						<button type="button" class="btn btn-outline-primary block tambahBuku" data-bs-toggle="modal" data-bs-target="#border-less">Tambah Buku</button>
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
									<th>Stok</th>
									<th>Dipinjam</th>
									<th>Dibooking</th>
									<th>Gambar</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($buku as $b) : ?>
									<tr>
										<td><?= $i++; ?></td>
										<td><?= $b['judul_buku']; ?></td>
										<td><?= $b['pengarang']; ?></td>
										<td><?= $b['penerbit']; ?></td>
										<td><?= $b['tahun_terbit']; ?></td>
										<td><?= $b['stok']; ?></td>
										<td><?= $b['dipinjam']; ?></td>
										<td><?= $b['dibooking']; ?></td>
										<td>
											<img src="<?= base_url('assets/img/upload/' . $b['image']); ?>" alt="" class="rounded" style="width: 100px;">
										</td>
										<td>
											<div class="d-flex flex-column">
												<button class="btn btn-sm btn-outline-primary my-3 editBuku" data-id="<?= $b['id']; ?>" data-bs-toggle="modal" data-bs-target="#border-less">Ubah</button>
												<button class="btn btn-sm btn-outline-danger hapusBuku" data-bs-toggle="modal" data-bs-target="#hapusbuku" data-id="<?= $b['id']; ?>">Hapus</button>
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
					<h5 class="modal-title"><span class="title-modal-buku">Tambah Buku </span><span class="text-danger text-sm">(*) wajib diisi</span></h5>
					<button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
						<i data-feather="x"></i>
					</button>
				</div>
				<form action="<?= base_url('buku'); ?>" method="POST" enctype="multipart/form-data" id="formBuku">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="judul-buku">Judul Buku <span class="text-danger text-sm">*</span></label>
									<input type="text" id="judul-buku" class="form-control" placeholder="Judul Buku" name="judul_buku" required />
								</div>
							</div>
							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="kategori">Kategori Buku <span class="text-danger text-sm">*</span></label>
									<select class="form-select" id="kategori" name="id_kategori">
										<option value="null">--Pilih--</option>
										<?php foreach ($kategori as $k) : ?>
											<option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="pengarang">Pengarang <span class="text-danger text-sm">*</span></label>
									<input type="text" id="pengarang" class="form-control" placeholder="Nama pengarang" name="pengarang" required />
								</div>
							</div>
							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="penerbit">Penerbit <span class="text-danger text-sm">*</span></label>
									<input type="text" id="penerbit" class="form-control" name="penerbit" placeholder="penerbit" required />
								</div>
							</div>
							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="tahun_terbit">Tahun Terbit <span class="text-danger text-sm">*</span></label>
									<input type="number" id="tahun_terbit" class="form-control" name="tahun_terbit" placeholder="Tahun Terbit" required />
								</div>
							</div>
							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="isbn">ISBN <span class="text-danger text-sm">*</span></label>
									<input type="number" id="isbn" class="form-control" name="isbn" placeholder="Isbn" required />
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="jml_halaman">Jumlah Halaman <span class="text-danger text-sm">*</span></label>
									<input type="number" id="jml_halaman" class="form-control" name="jml_halaman" placeholder="Jumlah Halaman Buku" required />
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="stok">Nominal Stok <span class="text-danger text-sm">*</span></label>
									<input type="number" id="stok" class="form-control" name="stok" placeholder="Nominal Stok" required />
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="form-group">
									<label for="stok">Gambar <span class="text-danger text-sm">*</span></label>
									<input type="file" class="form-control" name="image" onchange="loadFile(event)" />
									<input type="hidden" name="old_pict">
								</div>
							</div>

							<div class="col-md-6 col-12">
								<div class="w-25 mt-3 rounded">
									<img src class="img-fluid shadow rounded" id="img">
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

	<div class="modal fade text-left modal-borderless" id="hapusbuku" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-light">Apakah Anda Yakin ingin menghapus buku <span class="buku text-danger"></span></h5>
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