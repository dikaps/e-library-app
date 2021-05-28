<div class="grid xl:grid-cols-3 grid-cols-1 h-screen">
	<div class="bg-gray-500 overflow-hidden col-span-1 xl:block hidden">
		<img src="<?= base_url('assets/user/'); ?>img/login-forgot.jpg" alt="image" />
	</div>
	<div class="lg:col-span-2 flex items-center justify-center relative">
		<div class="xl:w-1/2 sm:w-4/5 lg:w-1/2 w-4/5 flex flex-col">
			<h2 class="text-2xl font-semibold mb-7 text-secondary-100">Lupa Sandi?</h2>
			<?= $this->session->flashdata('pesan'); ?>
			<span class="font-light"> Masukan Email yang anda gunakan untuk mendaftar,kami akan mengirimkan intruksi untuk mengubah password anda.</span>

			<form action="<?= base_url('autentifikasi/lupaPassword'); ?>" method="POST">
				<div class="text-secondary-100 flex flex-col my-5">
					<label for="email" class="font-semibold mb-3">Email </label>
					<input type="email" name="email" id="email" class="bg-secondary-400 border-2 focus:border-gray-400 focus:bg-secondary-300 outline-none rounded-md px-4 py-2 text-secondary-100" placeholder="example@example.com" required />
					<?= form_error('email', '<span style="color:#d9534f;">', '</span>'); ?>
				</div>

				<button type="submit" class="bg-warning-200 px-20 text-white py-3 rounded xl:w-auto w-full hover:bg-yellow-500">
					Kirim Kode Verifikasi
				</button>
			</form>
			<span class="lg:absolute lg:block hidden text-center my-3 xl:my-0 top-10 left-40 rounded-full text-secondary-100">
				<a href="<?= base_url('autentifikasi'); ?>" class="text-primary-200 flex items-center">
					<svg class="mr-2" width="8.164" height="17.328" viewBox="0 0 10.164 18.328">
						<path id="Path_11" data-name="Path 11" d="M12.75,20.5,5,12.75,12.75,5" transform="translate(-4 -3.586)" fill="none" stroke="rgba(42, 134, 226, 200)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
					</svg>
					Kembali
				</a>
			</span>
		</div>
	</div>
</div>