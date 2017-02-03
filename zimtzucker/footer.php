	</main>

		<footer class="menu-back-dole">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu') ); ?>
		</footer>

	<div id="checkout-button">
		<img src="<?php echo get_bloginfo('template_url'); ?>/image/checkout-140.png" srcset="<?php echo get_bloginfo('template_url'); ?>/image/checkout-140.png 140w, <?php echo get_bloginfo('template_url'); ?>/image/checkout-70.png 70w" alt="Show Cart" class="unclickable">
	</div>
	<div id="checkout-div">
		<img src="<?php echo get_bloginfo('template_url'); ?>/image/close.png" class="close-window unclickable" alt="Close window">
		<div id="cart-list">
			<h1>Your Cart:</h1>
			<table>
			</table>
			<p>Total: <span>00,00 €</span></p>
			<button>☞</button>
		</div>
		<div id="cart-form">
			<div id="form-back-button"><<</div>
			<h1>Enter your contact details:</h1>
			<form id="order-form">
				<label for="name">Name:</label>
				<input type="text" name="name" id="name" required>
				<label for="phone">Phone:</label>
				<input type="number" name="phone" id="phone" required>
				<label for="email">E-mail:</label>
				<input type="text" name="email" id="email" required>
				<label for="address">Address:</label>
				<input type="text" name="address" id="address" required>
				<label for="additional">Additional Instructions:</label>
				<textarea id="additional" name="additional" rows="3"></textarea>
				<button>✓</button>
			</form>
		</div>
		<div id="cart-aftermath">
			<h1>Thank you for your order. Our staff will contact you soon.</h1>
		</div>
	</div>


	<div id="posts-data" style="display: none;">
	<?php
	$dataObject = array();
	// List of Category IDs to query
	$categoriesList = [8, 7, 6, 5, 4, 3, 10];

	foreach ($categoriesList as $key => $value) {
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			'cat' => $value
		);
		$query = new WP_Query( $args );
		
		$categoryName = get_category($value)->slug;


		$dataObject[$categoryName] = array();

		while ( $query->have_posts() ) {
			$query->the_post();
			$dataObject[$categoryName][] = [
				'id' => get_the_ID(),
				'name' => get_the_title(),
				'price' => get_field('price'),
				'image' => get_field('image')['sizes']['Product'],
				'description' => htmlentities( get_the_content(), ENT_QUOTES )
			];
		}
		wp_reset_postdata();
	}

	echo json_encode($dataObject, JSON_FORCE_OBJECT);

	?>



	</div>

	<?php wp_footer(); ?>

</body>
</html>