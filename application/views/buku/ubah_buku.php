<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row justify-content-around">
        <div class="col-12">
            <div class="card mb-3" style="max-width: 54rem;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/upload/') . $buku['image']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Buku <?= $buku['judul_buku']; ?></h5>
                            <form action="<?= base_url('buku/ubahBuku'); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="old_pict" value="<?= $buku['image']; ?>">
                                <input type="hidden" name="id" value="<?= $buku['id']; ?>">
                                <div class="form-group">
                                    <label for="judul_buku">Judul Buku</label>
                                    <input type="text" class="form-control formcontrol-user" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku" value="<?= $buku['judul_buku']; ?>">
                                </div>

                                <div class="form-group">
                                    <select name="id_kategori" class="custom-select form-control-user">
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($kategori as $k) : ?>
                                            <?php if ($k['id'] == $buku['id']) : ?>
                                                <option value="<?= $k['id']; ?>" selected><?= $k['kategori']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="pengarang" name="pengarang" placeholder="Masukkan nama pengarang" value="<?= $buku['pengarang']; ?>">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control formcontrol-user" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit" value="<?= $buku['penerbit']; ?>">
                                </div>

                                <div class="form-group">
                                    <select name="tahun" class="custom-select form-control-user">
                                        <option value="">Pilih Tahun</option>
                                        <?php
                                        for ($i = date('Y'); $i > 1000; $i--) : ?>
                                            <?php if ($i == $buku['tahun_terbit']) : ?>
                                                <option value="<?= $i; ?>" selected><?= $i; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="isbn" name="isbn" placeholder="Masukkan ISBN" value="<?= $buku['isbn']; ?>">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok" value="<?= $buku['stok']; ?>">
                                </div>

                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="image">Pilih Gambar</label>
                                    </div>
                                    <div class="col-3">

                                        <input type="file" id="image" name="image">
                                    </div>
                                </div>

                                <div class="form-group float-right mt-3">
                                    <a href="<?= base_url('buku'); ?>" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->