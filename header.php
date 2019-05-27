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

$favicon = fw_get_db_settings_option('ul_general_favicon');
$opengraph_title = fw_get_db_settings_option('ul_general_opengraph_title');
$opengraph_description = fw_get_db_settings_option('ul_general_opengraph_description');
$opengraph_image = fw_get_db_settings_option('ul_general_opengraph_image');
$opengraph_image_width = fw_get_db_settings_option('ul_general_opengraph_image_width');
$opengraph_image_height = fw_get_db_settings_option('ul_general_opengraph_image_height');

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	
	<!-- Favicon -->
	<?php if ($favicon != '') : ?>
		<link rel="icon" type="image/png" href="<?php esc_attr_e($favicon['url']); ?>" />
	<?php else : ?>
		<link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/favicon.png" />
	<?php endif; ?>

	<!-- Open Graph -->
    <?php if ($opengraph_title != '') : ?>
	    <meta property="og:title" content="<?php esc_attr_e($opengraph_title); ?>" />
	    <?php if ($opengraph_description != '') : ?>
	    	<meta property="og:description" content="<?php esc_attr_e($opengraph_description); ?>" />
	    <?php endif; ?>
	    <meta property="og:type" content="website" />
	    <meta property="og:url" content="<?php echo get_permalink(); ?>" />
	    <?php if ($opengraph_image != '') : ?>
		    <meta property="og:image" content="<?php esc_attr_e($opengraph_image['url']); ?>" />
		    <?php if ($opengraph_image_width != '') : ?>
		   		<meta property="og:image:width" content="<?php esc_attr_e($opengraph_image_width); ?>" />
		    <?php endif; ?>
		    <?php if ($opengraph_image_height != '') : ?>
				<meta property="og:image:height" content="<?php esc_attr_e($opengraph_image_height); ?>" />
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <section class="l-main-wrapper">
	    <section class="l-main">
	    	<?php
	    		// Header template
				get_template_part( 'template-parts/header' );
	    	?>
