<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package default-theme
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/favicon.png" />

	<!-- Open Graph -->
    <meta property="og:title" content="Open Graph - Title" />
    <meta property="og:description" content="Open Graph - Description" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo get_permalink(); ?>" />
	<meta property="og:image" content="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/open-graph-image.png" />
		<meta property="og:image:width" content="300" />
	<meta property="og:image:height" content="200" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <section class="l-main-wrapper">
	    <section class="l-main">
	    	<?php
	    		// Header template
				get_template_part( 'template-parts/header' );
	    	?>
