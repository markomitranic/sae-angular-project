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
		table += '<img src="/wp-content/themes/zimtzucker/image/remove.png" class="remove-button unclickable" alt="Remove item" data-id="' + ordered_item.id + '"></td></tr>';
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

function sendEmailOrder(formObject) {
	// Add data from the food order itself
	formObject.order = JSON.parse(getCookie('ordered'));
	// Clear cookie
	setCookie("ordered", "false", -1);
	var path = '/order-sent/';
	jQuery.redirect(path, formObject);
}

function onEmailSent(data) {
	console.log(data);
}

function objectFromForm($form) {
	var data = {};
	data.address = {};
	var inputsArray = [];

	// Regular Inputs and Textareas
	$form.children('input, textarea').each(function(index, element) {
		$element = $(element);
		var fieldName = $element.attr('name');
		var fieldValue = $element.val();
		data["address"][fieldName] = fieldValue;
	});

	return data;
}


$('#order-form').validate({
	rules : {
		name : 'required',
		phone : 'required',
		address : 'required',
		email : {
			email : true,
			required : true
		}
	}
});
