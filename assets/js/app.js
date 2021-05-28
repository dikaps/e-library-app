let loadFile = (event) => {
	let img = document.querySelector("#img");
	img.src = URL.createObjectURL(event.target.files[0]);
	img.onload = () => {
		URL.revokeObjectURL(img.src);
	};
};

$(document).ready(function () {
	let baseUrl = "http://localhost/e-library/";
	let pesan = $("#pesan").data("pesan");
	if (pesan) {
		let color = "";
		let rules = $("#pesan").data("rules");
		if (rules == "berhasil") {
			color = "#0275d8";
		} else {
			color = "#d9534f";
		}
		Toastify({
			text: pesan,
			duration: 3000,
			close: true,
			backgroundColor: color,
		}).showToast();
	}

	// ajax kategori
	$(".tambahKategori").click(function (e) {
		e.preventDefault();
		$(".modal-title").text("Tambah Kategori");
		$(".kategoriForm").attr("action", baseUrl + "buku/kategori");
		$("#btn").text("Tambah");
		$(".inputKategori").val("");
	});

	$(document).on("click", ".editKategori", function (e) {
		e.preventDefault();
		const id = $(this).data("id");

		$(".modal-title").text("Ubah Kategori");
		$(".kategoriForm").attr("action", baseUrl + "buku/ubahKategori/" + id);
		$("#btn").text("Ubah");

		$.ajax({
			type: "POST",
			url: baseUrl + "buku/getKategori",
			data: {
				id: id,
			},
			dataType: "json",
			success: function (response) {
				$(".idKategori").val(response.id);
				$(".inputKategori").val(response.kategori);
				// console.log(response);
			},
		});
	});

	$(document).on("click", ".hapusKategori", function (e) {
		e.preventDefault();
		const id = $(this).data("id");
		$(".linkHapus").attr("href", baseUrl + "buku/hapusKategori/" + id);
	});

	// ajax buku
	$(".tambahBuku").click(function (e) {
		e.preventDefault();
		$(".title-modal-buku").text("Tambah Buku ");
		$("#formBuku").attr("action", baseUrl + "buku/");
		$(".btn-tambah").text("Tambah");
		$("#formBuku").attr("action", baseUrl + "buku");
		$("input[name=judul_buku]").val("");
		$("select[name=id_kategori]").val("null");
		$("input[name=pengarang]").val("");
		$("input[name=penerbit]").val("");
		$("input[name=tahun_terbit]").val("");
		$("input[name=isbn]").val("");
		$("input[name=stok]").val("");
		$("#img").attr("src", "");
		$("input[name=jml_halaman]").val("");
	});

	$(document).on("click", ".editBuku", function (e) {
		e.preventDefault();
		const id = $(this).data("id");
		$(".title-modal-buku").html("Ubah Buku ");
		$(".btn-tambah").text("Ubah");
		$("#formBuku").attr("action", baseUrl + "buku/ubahBuku/" + id);

		$.ajax({
			type: "POST",
			url: baseUrl + "buku/getBuku",
			data: { id: id },
			dataType: "json",
			success: function (res) {
				console.log(res);

				$("input[name=judul_buku]").val(res.judul_buku);
				$("select[name=id_kategori]").val(res.id_kategori);
				$("input[name=pengarang]").val(res.pengarang);
				$("input[name=penerbit]").val(res.penerbit);
				$("input[name=tahun_terbit]").val(res.tahun_terbit);
				$("input[name=isbn]").val(res.isbn);
				$("input[name=stok]").val(res.stok);
				$("input[name=jml_halaman]").val(res.jml_halaman);
				$("input[name=old_pict]").val(res.image);
				$("#img").attr("src", baseUrl + "assets/img/upload/" + res.image);
				$("#img").removeClass("d-none");
			},
		});
	});

	$(document).on("click", ".hapusBuku", function (e) {
		e.preventDefault();
		const id = $(this).data("id");
		$(".linkHapus").attr("href", baseUrl + "buku/hapusBuku/" + id);

		$.ajax({
			type: "POST",
			url: baseUrl + "buku/getBuku",
			data: { id: id },
			dataType: "json",
			success: function (res) {
				$(".buku").text(res.judul_buku);
			},
		});
	});

	// ajax anggota
	$(".tambahAnggota").click(function (e) {
		e.preventDefault();
		$(".title-modal-anggota").text("Tambah Anggota");
		$(".formAnggota").attr("action", baseUrl + "user/anggota");

		$("input[name=email]").removeAttr("readonly", "readonly");
		$("input[name=password]").removeAttr("readonly", "readonly");
		$("input[name=password2]").removeAttr("readonly", "readonly");

		$("input[name=nama]").val("");
		$("input[name=email]").val("");
		$("input[name=notel]").val("");
		$("textarea[name=alamat]").val("");
	});

	$(document).on("click", ".ubahAnggota", function (e) {
		e.preventDefault();
		const id = $(this).data("id");
		$(".title-modal-anggota").text("Ubah Data Anggota");
		$(".formAnggota").attr("action", baseUrl + "user/ubahAnggota/" + id);
		$("input[name=email]").attr("readonly", "readonly");
		$("input[name=password]").attr("readonly", "readonly");
		$("input[name=password2]").attr("readonly", "readonly");

		$.ajax({
			type: "POST",
			url: baseUrl + "user/getAnggota",
			data: { id: id },
			dataType: "json",
			success: function (res) {
				$("input[name=nama]").val(res.nama);
				$("input[name=email]").val(res.email);
				$("input[name=notel]").val(res.no_telp);
				$("textarea[name=alamat]").val(res.alamat);
			},
		});
	});

	$(document).on("click", ".hapusAnggota", function (e) {
		e.preventDefault();
		const id = $(this).data("id");
		$(".linkHapus").attr("href", baseUrl + "user/hapusAnggota/" + id);

		$.ajax({
			type: "POST",
			url: baseUrl + "user/getAnggota",
			data: { id: id },
			dataType: "json",
			success: function (res) {
				$(".namaAnggota").text(res.nama);
			},
		});
	});

	$(document).on("click", ".btnStatus", function () {
		// <?= base_url('pinjam/ubahStatus/' . $p['id_buku'] . '/' . $p['no_pinjam']); ?>
		const idBuku = $(this).data("idbuku");
		const noPinjam = $(this).data("nopinjam");

		$(".konfirmasiStatusform").attr(
			"action",
			baseUrl + "pinjam/ubahStatus/" + idBuku + "/" + noPinjam
		);

		$.ajax({
			type: "POST",
			url: baseUrl + "pinjam/getTotalDenda",
			data: { noPinjam: noPinjam },
			success: function (res) {
				$("input[name=total_denda]").val(res);
				$("input[name=total_denda]").attr("readonly", "readonly");
			},
		});
	});

	// ajax daftar booking
	$(document).on("click", ".btnBookingDetail", function (e) {
		e.preventDefault();
		const idBooking = $(this).data("id");

		$.ajax({
			type: "POST",
			url: baseUrl + "pinjam/detailBooking",
			data: {
				idBooking: idBooking,
			},
			success: function (res) {
				$(".data").html(res);
			},
		});

		$.ajax({
			type: "POST",
			url: baseUrl + "pinjam/getBooking",
			data: { idBooking: idBooking },
			dataType: "json",
			success: function (response) {
				$("input[name=nama_peminjam]").val(response.nama);
				$("input[name=idBooking]").val(response.id_booking);
			},
		});
	});

	$(document).on("click", ".btnKonfirmasi", function (e) {
		e.preventDefault();
		const idBooking = $(this).data("id");
		$(".konfirmasiPinjam").attr(
			"action",
			baseUrl + "pinjam/pinjamAct/" + idBooking
		);

		$.ajax({
			type: "POST",
			url: baseUrl + "pinjam/getBooking",
			data: { idBooking: idBooking },
			dataType: "json",
			success: function (response) {
				$(".namaPeminjam").text(response.nama);
			},
		});
	});

	// ajax profile
	$("#editProfile").click(function (e) {
		e.preventDefault();
		const id = $(this).data("id");
		$("#formUbahProfile").attr("action", baseUrl + "user/ubahProfil/");

		$.ajax({
			type: "POST",
			dataType: "json",
			url: baseUrl + "user/getUser",
			data: { id: id },
			success: function (res) {
				$("input[name=nama]").val(res.nama);
				$("input[name=email]").val(res.email);
				$("input[name=notel]").val(res.no_telp);
				$("textarea[name=alamat]").val(res.alamat);
			},
		});
	});
});
