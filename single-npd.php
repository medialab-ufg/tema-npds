<?php get_header(); ?>

<!-- Get the banner to display -->
<?php get_template_part( 'template-parts/bannerHeader' ); ?>
<!-- Get the menu if is create in panel admin -->
<?php get_template_part( 'template-parts/menuBellowBanner' ); ?>

<main role="main" class="mt-5 max-large margin-one-column">
    <div class="row">
        <div class="col col-sm mx-sm-auto">
            
			<?php get_template_part('template-parts/loop', 'singular'); ?>
			
			<?php do_shortcode('[list_events url=http://mapas.cultura.gov.br ]'); ?>
			
        </div>
    </div><!-- /.row -->
	<?php echo do_shortcode('[list_events url=http://museus.cultura.gov.br ]'); ?>
</main>
<?php get_footer(); ?>