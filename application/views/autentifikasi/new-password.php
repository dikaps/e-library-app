<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900">Ubah Password untuk</h1>
                                    <h5 class="mb-4"><?= $this->session->userdata('reset_email');?></h5>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
                                <form class="user" method="post" action="<?= base_url('autentifikasi/passwordBaru'); ?>">
                                    <div class="form-gorup">
                                        <input type="password" class="form-control form-control-user " id="password_baru1" name="password_baru1" placeholder="Masukkan Password Baru">
                                        <?= form_error('password_baru1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-gorup">
                                        <input type="password" class="form-control form-control-user mt-3" id="password_baru2" name="password_baru2" placeholder="Ulangi Password">
                                        <?= form_error('password_baru2', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-user btn-block mt-3">
                                            Ubah Password
                                        </button>
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