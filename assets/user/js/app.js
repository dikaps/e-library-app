let loadFile = (event) => {
	let img = document.querySelector("#img");
	img.src = URL.createObjectURL(event.target.files[0]);
	img.onload = () => {
		URL.revokeObjectURL(img.src);
	};
};

const baseUrl = "http://localhost/e-library/";

$(document).ready(function () {
	$("#nav").click(function (e) {
		e.preventDefault();
		$("#dropdown").toggleClass("hidden");
	});

	let judul = document.querySelectorAll(".judul");
	let cutText;
	for (let i = 0; i < judul.length; i++) {
		if (judul[i].innerHTML.length > 22) {
			cutText = judul[i].innerHTML.slice(0, 30) + "....";
			judul[i].innerHTML = cutText;
		}
	}

	let count = 3;
	loadBuku(count);
	function loadBuku(count, keyword) {
		$.ajax({
			type: "POST",
			url: "http://localhost/e-library/home/loadBuku",
			data: { counting: count, keyword: keyword },
			success: function (response) {
				$("#buku").html(response);
			},
		});
	}

	$("#load").click(function (e) {
		count = count + 3;
		e.preventDefault();
		loadBuku(count);
	});

	setInterval(() => {
		$(".pesan").hide();
	}, 3000);

	$(document).on("click", ".btnKonfirmasi", function (e) {
		e.preventDefault();
		const href = $(this).attr("href");
		Swal.fire({
			title: "Apakah anda yakin",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: `Hapus`,
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: href,
					dataType: "json",
					success: function (res) {
						if (res.hasil == "kosong") {
							Swal.fire({
								title: res.type,
								text: res.pesan,
								icon: "warning",
								timer: 1500,
							});
							setTimeout(() => {
								document.location.href = baseUrl;
							}, 2000);
						} else {
							Swal.fire({
								title: res.type,
								text: res.pesan,
								icon: "success",
								timer: 1700,
							});
							loadDataBooking();
							loadJumlahBooking();
						}
					},
				});
			}
		});
	});

	const pesan = $(".flash-data").data("flashdata");
	const type = $(".flash-data").data("type");
	if (pesan) {
		if (type == "Berhasil") {
			Swal.fire({
				title: type,
				text: pesan,
				icon: "success",
				timer: 1700,
			});
		} else {
			Swal.fire({
				title: type,
				text: pesan,
				icon: "error",
				timer: 1700,
			});
		}
	}

	loadJumlahBooking();

	function loadJumlahBooking() {
		$.ajax({
			type: "POST",
			url: baseUrl + "booking/getJumlahBooking",
			dataType: "json",
			success: function (res) {
				$("#jmlBooking").text(res.hasil);
			},
		});
	}

	$(document).on("click", ".konfirmasiBooking", function (e) {
		e.preventDefault();
		const url = $(this).attr("href");

		$.ajax({
			type: "POST",
			url: url,
			dataType: "json",
			success: function (res) {
				if (res.type == "Berhasil") {
					Swal.fire({
						title: res.type,
						text: res.pesan,
						icon: "success",
					});

					loadJumlahBooking();
					loadDataBooking();
				} else {
					Swal.fire({
						title: res.type,
						text: res.pesan,
						icon: "error",
					});
				}
			},
		});
	});

	loadDataBooking();
	function loadDataBooking() {
		$.ajax({
			type: "POST",
			url: baseUrl + "booking/loadDataBooking",
			success: function (res) {
				$("#loadDataBooking").html(res);
			},
		});
	}

	$(".konfirmasiSelesai").click(function (e) {
		e.preventDefault();
		const href = $(this).attr("href");
		const username = $(".username").text();
		Swal.fire({
			title: "Apakah anda yakin?",
			text: "Ingin menyelesaikan booking buku ini",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: `Konfirmasi`,
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire({
					title: "Terimakasih " + username,
					text: "Buku yang anda pinjam sebagai berikut",
					icon: "success",
				});
				setTimeout(() => {
					document.location.href = href;
				}, 3000);
			}
		});
	});

	$(document).on("click", "#wishlist", function (e) {
		e.preventDefault();
		const id = $(this).data("id");

		$.ajax({
			type: "POST",
			url: baseUrl + "wishlist",
			data: {
				id: id,
			},
			dataType: "json",
			success: function (res) {
				console.log(res);
				if (res.status == 1) {
					cekWishlist();
				} else {
					Swal.fire({
						title: "Warning!",
						text: "Anda diharuskan login terlebih dahulu",
						icon: "warning",
					});
					setTimeout(() => {
						document.location.href = baseUrl + "autentifikasi";
					}, 1700);
				}
			},
		});
	});

	cekWishlist();
	function cekWishlist() {
		const id = $("#wishlist").data("id");
		$.ajax({
			type: "POST",
			url: baseUrl + "wishlist/cek",
			data: { id: id },
			dataType: "json",
			success: function (res) {
				if (res.status == 0) {
					$("#wishlist").addClass("bg-gray-400");
					$("#wishlist").removeClass("bg-red-600");
					$("#wishlist #text").text("Wishlist");
				} else {
					$("#wishlist").removeClass("bg-gray-400");
					$("#wishlist").addClass("bg-red-600");
					$("#wishlist #text").text("Hapus Wishlist");
				}
			},
		});
	}

	$("input[name=keyword]").keyup(function (e) {
		const keyword = $(this).val();
		if (keyword != 0) {
			loadBuku(50, keyword);
			$("#load").addClass("hidden");
		} else {
			loadBuku();
			$("#load").removeClass("hidden");
		}
	});
});
