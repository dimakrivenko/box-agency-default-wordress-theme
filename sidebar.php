<!--
	Sidebar in blog
-->

<?php if ( function_exists('dynamic_sidebar') && is_active_sidebar( 'sidebar-blog' ) ) : ?>
	<div class="sidebar-widget-list">
		<ul class="widget-list">
			<?php dynamic_sidebar( 'sidebar-blog' ); ?>
		</ul>
	</div>
<?php endif; ?>
