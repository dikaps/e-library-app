<?php if ($this->session->flashdata('pesan')) : ?>
	<div id="pesan" data-pesan="<?= $this->session->flashdata('pesan'); ?>" data-rules="<?= $this->session->flashdata('rules'); ?>" class="hidden"></div>
<?php endif; ?>
<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last mb-3">
					<h3>Kategori Buku</h3>

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
						<h4>Data Kategori</h4>
						<button type="button" class="btn btn-outline-primary block tambahKategori" data-bs-toggle="modal" data-bs-target="#border-less">Tambah Kategori</button>
					</div>

					<div class="card-body">
						<table class="table table-striped" id="table1">
							<thead>
								<tr>
									<th>#</th>
									<th>Kategori</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($kategori as $k) : ?>
									<tr>
										<td><?= $i++; ?></td>
										<td><?= $k['kategori']; ?></td>
										<td>
											<button class="btn btn-sm btn-outline-primary editKategori" data-bs-toggle="modal" data-bs-target="#border-less" data-id="<?= $k['id']; ?>">Ubah</button>
											<button class="btn btn-sm btn-outline-danger hapusKategori" data-bs-toggle="modal" data-bs-target="#hapusKategori" data-id="<?= $k['id']; ?>">Hapus</button>
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
					<h5 class="modal-title">Tambah Kategori</h5>
					<button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
						<i data-feather="x"></i>
					</button>
				</div>
				<form method="POST" action="<?= base_url('buku/kategori'); ?>" class="kategoriForm">
					<div class="modal-body">
						<input type="hidden" class="form-control idKategori" name="idKategori" />
						<input type="text" class="form-control inputKategori" placeholder="Nama Kategori" name="kategori" />
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
							<i class="bx bx-x d-block d-sm-none"></i>
							<span class="d-none d-sm-block">Tutup</span>
						</button>
						<button type="submit" class="btn btn-primary ml-1">
							<i class="bx bx-check d-block d-sm-none"></i>
							<span class="d-none d-sm-block" id="btn">Tambah</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade text-left modal-borderless" id="hapusKategori" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Apakah Anda Yakin?</h5>
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