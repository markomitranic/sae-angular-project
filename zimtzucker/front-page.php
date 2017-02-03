<?php

// Front Page
// This is a special type of template. If present, it will automatically be set as the front page for your website.
// Wordpress Tags Usage: https://codex.wordpress.org/Template_Tags


get_header();


?>



		<div id="svi-proizvodi">
			<ul class="proizvodi-line">
				<li id="risotto" class="product-category-link" data-category="risotto">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/risotto.jpg" class="naslov animacija">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/risotto-main.png" width="141" class="slika">
				</li>
				<li id="pan-cakes" class="product-category-link" data-category="pan_cakes">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/pan-cakes.jpg" class="naslov animacija">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/pan-cakes-main.png" width="141" class="slika">
				</li>
				<li id="musli" class="product-category-link" data-category="musli">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/musli.jpg" class="naslov animacija">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/musli-main.png" width="141" class="slika">
				</li>
				<li id="salat" class="product-category-link" data-category="salat">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/salat.jpg" class="naslov animacija">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/salat.png" width="141" class="slika">
				</li>
				<li id="kuchen" class="product-category-link" data-category="kuchen">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/kuchen.jpg" class="naslov animacija">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/kuchen-main.png" width="500" class="slika">
				</li>
				<li id="drinks" class="product-category-link" data-category="drinks">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/drinks.jpg" class="naslov animacija">
					<img src="<?php echo get_bloginfo('template_url'); ?>/image/drinks-main.png" width="80" class="slika">
				</li>              
			</ul>   
		</div> 


		<div id="proizvod-detalji">
			<div class="proizvod-slika-pozadina">
				<img src="<?php echo get_bloginfo('template_url'); ?>/image/proizvodi/pink-risotto.png" class="proizvod-slika">
			</div>
			<div id="opis">
				<h2>Pink Risotto Spargel & rote bete</h2>
				<h3>Spargel & rote bete Zutaten: Risotto, grüner Spargel, rote bete, Salz, Wasser, Weiß Wein, Parmesan, Butter, Sonnenblumen Öl, Wein Essig. Mit Laktose, Glutenfrei!</h3>
			</div>
			<img src="<?php echo get_bloginfo('template_url'); ?>/image/add-to-cart.png" id="add-to-cart">
			<div id="cena">
				<h5>5,90€</h5>
			</div>
		</div> 


<?php


get_footer();


?>