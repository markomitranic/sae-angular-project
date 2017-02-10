function toggleCartButton(cookie) {
	if (cookie && cookie !== '[]') {
		$('#checkout-button').fadeIn('slow');
	} else {
		$('#checkout-button').fadeOut('slow');
	}
}

function replaceCartData(ordered) {
	var listPage = $('#cart-list');
	var table = '';
	var cartValue = 0;
	$.each(ordered, function(key, value) {
		var ordered_item = findById(value, getAllData());
		cartValue += parseFloat(ordered_item.price);

		table += '<tr><td>';
		table += ordered_item.name + '</td><td>';
		table += ordered_item.price + '</td><td>';
		table += '<img src="image/remove.png" class="remove-button unclickable" alt="Remove item" data-id="' + ordered_item.id + '"></td></tr>';
	});
	listPage.find('table').html(table);

	// Add event listeners for remove buttons
	$('.remove-button').on('click', function() {
		removeFromCookie($(this).attr('data-id'));
		replaceCartData(JSON.parse(getCookie('ordered')));
	});

	// Calculate the value
	listPage.find('p span').html(cartValue.toFixed(2) + '€');
}

function verifyFormData() {
	var form = $('#cart-form form');
	var errors = false;

	if (form.find('#name').val() == '') { form.find('#name').css('background-color', 'red'); errors = true; }
	if (form.find('#phone').val() == '') { form.find('#phone').css('background-color', 'red'); errors = true; }
	if (form.find('#address').val() == '') { form.find('#address').css('background-color', 'red'); errors = true; }

	return errors;
}
