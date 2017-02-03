function changeContents(category, number) {

	// Get the data for the category
	var posts_array = getAllData();
	posts_array = posts_array[category];

	// Find the container
	var posts_container = $('#proizvod-detalji');
	posts_container.find('#proizvod-navigacija-levo').remove();
	posts_container.find('#proizvod-navigacija-desno').remove();

	// Fill the DOM with stuff
	var post_number = number || 0;
	var current_post = posts_array[post_number];

	posts_container.fadeOut('slow', function() {
		fillPost();
		posts_container.fadeIn('slow', function() {
			createNav(post_number);
		});
	});

	function fillPost() {
		posts_container.find('.proizvod-slika').attr('src', current_post.img);
		posts_container.find('#opis h2').html(current_post.name);
		posts_container.find('#opis h3').html(current_post.description);
		posts_container.find('#cena h5').html(current_post.price);
		posts_container.find('#add-to-cart').attr('data-id', current_post.id);
	}

	function createNav(current) {
		var min = (current <= 0) ? posts_array.length - 1 : current - 1;
		var max = (current >= posts_array.length - 1) ? 0 : current + 1;

		$('<div>', {
			'id' : 'proizvod-navigacija-levo',
			'text' : 'LEVO',
			'style' : 'display: none;'
		}).appendTo(posts_container).fadeIn('slow').on('click', function() {
			changeContents(category, min);
		});
		$('<div>', {
			'id' : 'proizvod-navigacija-desno',
			'text' : 'DESNO',
			'style' : 'display: none;',
		}).appendTo(posts_container).fadeIn('slow').on('click', function() {
			changeContents(category, max);
		});
	}




}


function getAllData() {
	return JSON.parse($('#posts-data').html());
}


function findById(needle, haystack) {
	var found = {};
	$.each(haystack, function(key, category) {
		$.each(category, function(key, product) {
			if (product.id == needle) {
				found = product;
			}
		});
	});
	return found;
}

