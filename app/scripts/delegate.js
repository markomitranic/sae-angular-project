$(document).ready(function() {

	// A nice fadein effect for the body
	$("body").css("display", "none");
	$("body").fadeIn(2000);



	// Menu links for the categories
	$('.product-category-link').on('click', function(e) {
		e.preventDefault();
		var category = $(this).data('category');
		changeContents(category);
		$("#svi-proizvodi").fadeOut(500);  
		$("#proizvod-detalji").fadeIn(500); 
	});

	// Listener for buying stuff
	$('#add-to-cart').on('click', function() {
		if (cookieExists('ordered') && getCookie('ordered') !== '[]') {
			addCookieData($(this).data('id'), getCookie('ordered'));
		} else {
			addCookieData($(this).data('id'), false);
		};
		toggleCartButton(getCookie('ordered')); // Jednom nakon loada
		replaceCartData(JSON.parse(getCookie('ordered')));	
	});

	toggleCartButton(getCookie('ordered')); // Jednom nakon loada

	// Listen for cart showing
	$('#checkout-button').on('click', function() {
		$('#checkout-div').fadeIn('slow');
		replaceCartData(JSON.parse(getCookie('ordered')));
	});

	// Listen for cart Hide
	$('#checkout-div .close-window').on('click', function() {
		$('#checkout-div').fadeOut('slow');
	});

	// Listen for next Step
	$('#cart-list button').on('click', function(e) {
		e.preventDefault();
		$('#cart-list').slideUp('slow');
		$('#cart-form').slideDown('slow');
	});
	$('#cart-form form button').on('click', function(e) {
		e.preventDefault();
		$(this).closest('form').find('input').css('background-color', 'white');
		var form_has_errors = verifyFormData();

		if (!form_has_errors) {
			console.log('SEND EMAIL!!!');
		}
	});


	
	
	// Mobile menu
	$("#mobile-dugme").click(function(){
		$("#levo_menu").fadeIn(200);
		$("#mobile-dugme2").fadeIn(200);
	});		

	$("#mobile-dugme2").click(function(){
		$("#levo_menu").fadeOut(200);
		$("#mobile-dugme2").fadeOut(200);
	});		


}); 