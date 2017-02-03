function changeContents(category, number) {

	// Get the data for the category
	var posts_array = getAllData();

	posts_array = posts_array[category];

	// Remove any old navigation if there is any.
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
		posts_container.find('.proizvod-slika').attr('src', current_post.image);
		posts_container.find('#opis h2').html(current_post.name);
		posts_container.find('#opis h3').html(decodeHtmlEntities(current_post.description));
		posts_container.find('#cena h5').html(current_post.price + '€');
		posts_container.find('#add-to-cart').attr('data-id', current_post.id);
	}

	function decodeHtmlEntities(html) {
	    var txt = document.createElement("textarea");
	    txt.innerHTML = html;
	    return txt.value;
	}

	function createNav(current) {
		var min = (current <= 0) ? 'kraj' : current - 1;
		var max = (current >= Object.keys(posts_array).length - 1) ? 'kraj' : current + 1;

		if (min !== 'kraj') {
			$('<div>', {
				'id' : 'proizvod-navigacija-levo',
				'text' : '',
				'style' : 'display: none;'
			}).appendTo(posts_container).fadeIn('slow').on('click', function() {
				changeContents(category, min);
			});
		}
		if (max !== 'kraj') {
			$('<div>', {
				'id' : 'proizvod-navigacija-desno',
				'text' : '',
				'style' : 'display: none;',
			}).appendTo(posts_container).fadeIn('slow').on('click', function() {
				changeContents(category, max);
			});
		}
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

