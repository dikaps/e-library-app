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
});
