<?php
/**
 * WooCommerce Template Functions.
 *
 */

if ( ! function_exists( 'ul_cart_link' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function ul_cart_link() {
		?>
			<a class="cart-icon" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Посмотреть корзину', 'ul' ); ?>">
				<span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'ul_header_search' ) ) {
	function ul_header_search() { ?>
		<div class="header-search">
			<span class="search-icon"></span>
			<div class="search-block">
				<form role="search" method="get" class="woocommerce-product-search search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>">
						<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'ul' ); ?></span>
						<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'ul' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
					</label>
					<button type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'ul' ); ?>"><?php echo esc_html_x( 'Search', 'submit button', 'ul' ); ?></button>
					<input type="hidden" name="post_type" value="product" />
				</form>
			</div>
		</div>
	<?php }
}

if ( ! function_exists( 'ul_header_account' ) ) {
	function ul_header_account() { ?>
		<div class="header-account">
			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="account-icon"></a>
			<?php if (is_user_logged_in()) : ?>
				<div class="account-menu">
					<ul>
						<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
							<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
								<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	<?php }
}

if ( ! function_exists( 'ul_header_cart' ) ) {
	/**
	 * Display Header Cart
	 *
	 * @since  1.0.0
	 * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function ul_header_cart() {
		if ( ul_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
			?>
		<div class="header-cart <?php echo esc_attr( $class ); ?>">
			<?php ul_cart_link(); ?>

			<div class="mini-cart">
				<div class="widget_shopping_cart_content">
					<?php woocommerce_mini_cart(); ?>
				</div>
				<?php //the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</div>
		</div>
			<?php
		}
	}
}

if ( ! function_exists( 'ul_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments
	 * Ensure cart contents update when products are added to the cart via AJAX
	 *
	 * @param  array $fragments Fragments to refresh via AJAX.
	 * @return array            Fragments to refresh via AJAX
	 */
	function ul_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		ul_cart_link();
		$fragments['a.cart-icon'] = ob_get_clean();

		return $fragments;
	}
}


if ( ! function_exists( 'ul_template_loop_product_thumbnail' ) ) {

    /**
     * Get the product thumbnail for the loop.
     */
    function ul_template_loop_product_thumbnail() {
        echo '<div class="image">' . woocommerce_get_product_thumbnail() . '<span class="text">' . __('Подробнее', 'ul') . '</span></div>'; // WPCS: XSS ok.
    }
}


/**
 * Get HTML for a gallery image.
 *
 * Woocommerce_gallery_thumbnail_size, woocommerce_gallery_image_size and woocommerce_gallery_full_size accept name based image sizes, or an array of width/height values.
 *
 * @since 3.3.2
 * @param int  $attachment_id Attachment ID.
 * @param bool $main_image Is this the main image or a thumbnail?.
 * @return string
 */
function ul_get_gallery_image_html( $attachment_id, $main_image = false ) {
	$flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
	$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
	$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
	$image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
	$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
	$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
	$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
	$image             = wp_get_attachment_image( $attachment_id, $image_size, false, array(
		'title'                   => get_post_field( 'post_title', $attachment_id ),
		'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
		'data-src'                => $full_src[0],
		'data-large_image'        => $full_src[0],
		'data-large_image_width'  => $full_src[1],
		'data-large_image_height' => $full_src[2],
		'class'                   => $main_image ? 'wp-post-image' : '',
	) );

	// $imageResult = null;

	// if ($main_image) {
	// 	$imageResult = $image;
	// } else {
	// 	$imageResult = '<div class="img">' . $thumbnail_src[0] . '</div>';
	// }

	// return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>';
	return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" class="' . ($main_image ? 'woocommerce-product-gallery__image' : 'item') . '">' . $image . '</div>';
}


/**
 * Get coupon display HTML.
 *
 * @param string|WC_Coupon $coupon Coupon data or code.
 */
function ul_cart_totals_coupon_html( $coupon ) {
	if ( is_string( $coupon ) ) {
		$coupon = new WC_Coupon( $coupon );
	}

	$discount_amount_html = '';

	$amount               = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax );
	$discount_amount_html = '-' . wc_price( $amount );

	if ( $coupon->get_free_shipping() && empty( $amount ) ) {
		$discount_amount_html = __( 'Free shipping coupon', 'ul' );
	}

	$discount_amount_html = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon );
	$coupon_html          = $discount_amount_html . ' <a href="' . esc_url( add_query_arg( 'remove_coupon', rawurlencode( $coupon->get_code() ), defined( 'WOOCOMMERCE_CHECKOUT' ) ? wc_get_checkout_url() : wc_get_cart_url() ) ) . '" class="woocommerce-remove-coupon" data-coupon="' . esc_attr( $coupon->get_code() ) . '">' . __( 'Remove', 'ul' ) . '</a>';

	echo wp_kses( apply_filters( 'woocommerce_cart_totals_coupon_html', $coupon_html, $coupon, $discount_amount_html ), array_replace_recursive( wp_kses_allowed_html( 'post' ), array( 'a' => array( 'data-coupon' => true ) ) ) ); // phpcs:ignore PHPCompatibility.PHP.NewFunctions.array_replace_recursiveFound
}

if ( ! function_exists( 'ul_show_categories' ) ) {
	function ul_show_categories($args = array()) {
		$parentid = get_queried_object_id();
 
		$args = array(
		 'parent' => $parentid
		);
		 
		$terms = get_terms( 'product_cat', $args );
		 
		if ( $terms ) {
			echo '<ul class="product-cats">';
			foreach ( $terms as $term ) {
				echo '<li class="category">'; 
				echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
				echo '<div class="img">';
					woocommerce_subcategory_thumbnail( $term );
				echo '</div>';
				echo '<p>' . $term->name . '</p>';
				echo '</a>';
				echo '</li>';
			}
			echo '</ul>';
		}
	}
}
