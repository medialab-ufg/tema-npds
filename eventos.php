<?php get_header(); ?>

<!-- Get the banner to display -->
<?php get_template_part( 'template-parts/bannerHeader' ); ?>
<!-- Get the menu if is create in panel admin -->
<?php get_template_part( 'template-parts/menuBellowBanner' ); ?>

<main role="main" class="mt-5 max-large margin-one-column">
    <div class="row">
        <div class="col col-sm mx-sm-auto">
            
			<?php if (is_single()): ?>
				<?php npds_the_events(); ?>
			<?php else: ?>
				<?php npds_all_events(); ?>
			<?php endif; ?>
			
        </div>
    </div><!-- /.row -->
</main>
<?php get_footer(); ?>