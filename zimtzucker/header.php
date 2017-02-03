<!--
Header Template
This is just a suggestion of what woudl be used within the header when making Wordpress templates.

Header menu can be created simply with calling a function. It will generate a simple ul>li>a list of menu items from that particular menu.
Creating header menus: https://developer.wordpress.org/reference/functions/wp_nav_menu/

If you are not into that kind of stuff and need special elements, classes and stuff, you can create a custom loop menu. This is what the second example is for.
-->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="Marko Jevremovic" content="MOONLIGHT EVENTS" />    
	<meta name="description" content="" />
	<meta name="keywords" content="">

    <title><?php echo get_the_title() . ' ~ ' . get_bloginfo('name'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	<!-- Force latest IE rendering engine & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<!-- Make IE recognise HTML5 elements for styling -->
	<!--[if lte IE 8]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<noscript>
		<strong>Warning!</strong>
		Your browser does not support HTML5 so some elements on this page are simulated using JScript. Unfortunately your browser has JScript disabled. Please enable it in order to display this page.
	</noscript>
	<![endif]-->

	<?php wp_head(); ?>
</head>	
<body>

	<header class="menu-back">

		<img src="<?php echo get_bloginfo('template_url'); ?>/image/logo.png" id="logo"/>
		<img src="<?php echo get_bloginfo('template_url'); ?>/image/delivery.png" id="delivery"/>
		<img src="<?php echo get_bloginfo('template_url'); ?>/image/mobile-icon.png" id="mobile-dugme">
		<img src="<?php echo get_bloginfo('template_url'); ?>/image/mobile-icon2.png" id="mobile-dugme2">


		<div id="levo_menu">

			<?php
				$menu_name = 'header-menu';
				 
				if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
				    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
				    $menu_items = wp_get_nav_menu_items($menu->term_id);


				    $menu_list = '<ul class="levi_bar">'; 
				    foreach ( (array) $menu_items as $key => $menu_item ) {
					    $classesList = '';

					    foreach ($menu_item->classes as $key => $value) {
					    	$classesList .= $value.' ';
					    }

				        $title = $menu_item->title;
				        $url = $menu_item->url;
				        $menu_list .= '<li class="'.$classesList.'" data-category="'.$menu_item->xfn.'"><a href="' . $url . '">'. $title . '</a></li>';
				    }
				    $menu_list .= '</ul>';

				} else {
				    $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
				}
				echo $menu_list;
			?>

		</div>
	</header>


	<main>

