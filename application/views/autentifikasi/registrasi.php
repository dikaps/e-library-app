<div class="grid xl:grid-cols-3 grid-cols-1 h-screen">
	<div class="bg-gray-500 overflow-hidden col-span-1 xl:block hidden">
		<img src="<?= base_url('assets/user/'); ?>img/daftar.jpg" alt="image" />
	</div>
	<div class="lg:col-span-2 flex items-center justify-center relative">
		<div class="xl:w-1/2 sm:w-4/5 lg:w-1/2 w-4/5 flex flex-col">
			<h2 class="text-2xl font-semibold mb-7 text-secondary-100">Daftar Akun</h2>

			<form action="<?= base_url('autentifikasi/registrasi'); ?>" method="POST">
				<div class="text-secondary-100 flex flex-col my-5">
					<label for="nama" class="font-semibold mb-3">Nama</label>
					<input type="text" name="nama" id="nama" class="bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" autofocus required value="<?= set_value('nama'); ?>" />
					<?= form_error('nama', '<span style="color:#d9534f;">', '</span>'); ?>
				</div>
				<div class="text-secondary-100 flex flex-col my-5">
					<label for="email" class="font-semibold mb-3">Email</label>
					<input type="text" name="email" id="email" class="bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" autofocus required value="<?= set_value('email'); ?>" />
					<?= form_error('email', '<span style="color:#d9534f;">', '</span>'); ?>
				</div>

				<div class="text-secondary-100 flex flex-col my-5">
					<label for="notel" class="font-semibold mb-3">No Telp</label>
					<input type="number" name="notel" id="notel" class="bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" autofocus required value="<?= set_value('notel'); ?>" />
					<?= form_error('notel', '<span style="color:#d9534f;">', '</span>'); ?>
				</div>

				<div class="text-secondary-100 flex flex-col my-5">
					<label for="alamat" class="font-semibold mb-3">Alamat</label>
					<textarea name="alamat" id="alamat" class="bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" required><?= set_value('alamat'); ?></textarea>
					<?= form_error('alamat', '<span style="color:#d9534f;">', '</span>'); ?>
				</div>

				<div class="text-secondary-100 flex justify-beetwen my-5">
					<div class="w-1/2">
						<label for="password1" class="font-semibold mb-3">Kata Sandi</label>
						<input type="password" name="password1" id="password1" class="bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" required />
						<?= form_error('password1', '<span style="color:#d9534f;">', '</span>'); ?>
					</div>
					<div class="w-1/2">
						<label for="password2" class="font-semibold mb-3">Ulangi Kata Sandi</label>
						<input type="password" name="password2" id="password2" class="bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" required />
						<?= form_error('passsword2', '<span style="color:#d9534f;">', '</span>'); ?>
					</div>
				</div>

				<button type=" submit" class="bg-warning-200 px-20 text-white py-3 rounded xl:w-auto w-full hover:bg-yellow-500">
					Daftar
				</button>
			</form>
			<span class="lg:absolute text-center my-3 xl:my-0 top-10 right-40 text-secondary-100">Sudah menjadi member? <a href="<?= base_url('autentifikasi'); ?>" class="text-primary-200">Masuk</a>.</span>
		</div>
	</div>
</div>