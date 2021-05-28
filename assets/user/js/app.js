let loadFile = (event) => {
	let img = document.querySelector("#img");
	img.src = URL.createObjectURL(event.target.files[0]);
	img.onload = () => {
		URL.revokeObjectURL(img.src);
	};
};

$(document).ready(function () {
	$("#nav").click(function (e) {
		e.preventDefault();
		$("#dropdown").toggleClass("hidden");
	});

	$("#wishlist").click(function (e) {
		e.preventDefault();
		$(this).toggleClass("bg-gray-400");
		$(this).toggleClass("bg-red-600");
	});

	let text = $(".judul").text();
	if (text.length > 22) {
		const cutText = text.slice(0, 20) + "....";
		$(".judul").text(cutText);
	}

	let count = 3;
	loadBuku(count);
	function loadBuku(count) {
		$.ajax({
			type: "POST",
			url: "http://localhost/e-library/home/loadBuku",
			data: { counting: count },
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

	$(".btnKonfirmasi").click(function (e) {
		e.preventDefault();
		const href = $(this).attr("href");
		Swal.fire({
			title: "Apakah anda yakin",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: `Hapus`,
			dangerMode: true,
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire("Berhasil dihapus!", "", "success");
				document.location.href = href;
			}
		});
	});

	const pesan = $(".flash-data").data("flashdata");
	if (pesan) {
		Swal.fire({
			title: pesan,
			icon: "success",
		});
	}
});
