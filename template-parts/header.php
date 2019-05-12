<header class="header">
	<div class="container">
        <div class="row">
            <div class="col-md-12">
				<?php if (has_nav_menu('header-menu')) : ?>
                	<nav class="top-menu">
                        <?php wp_nav_menu( array(
                            'theme_location'  => 'header-menu',
                            'container'       => '',
                            'container_class' => '', 
                            'container_id'    => '',
                            'menu_class'      => 'main-menu', 
                            'menu_id'         => '',
                            'depth'           => 0,
                            'fallback_cb'     => ''
                        ) ); ?>
                	</nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>