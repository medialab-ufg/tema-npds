<?php get_header(); ?>

<!-- Get the banner to display -->
<?php get_template_part( 'template-parts/bannerHeader' ); ?>
<!-- Get the menu if is create in panel admin -->
<?php get_template_part( 'template-parts/menuBellowBanner' ); ?>

<div class="container-fluid mt-5 max-large">
	<div class="row">

		<div class="col-sm margin-one-column">
			<div id="content" role="main">
				<?php get_template_part('template-parts/loop', 'singular'); ?>
			</div><!-- /#content -->
		</div>
		
	</div><!-- /.row -->
	
	<?php $noticias = new WP_Query('post_type=post'); ?>
	
	<?php if ($noticias->have_posts()): ?>
	
		<div class="row">
			<div class="col-sm margin-one-column">
				<div class="box-noticias">
					<div class="tainacan-title">
						<div class="border-bottom mb-5 border-jelly-bean tainacan-title-page" style="border-width: 2px !important;">
							<ul class="list-inline mb-1">
								<li class="list-inline-item text-midnight-blue font-weight-bold title-page">
									Notícias
								</li>
								<li class="list-inline-item float-right title-back"><a href="javascript:history.go(-1)"><?php _e('Back', 'tainacan-theme'); ?></a></li>
							</ul>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="col-lg-9">
							<ul class="box-noticias__lista">
								
								<?php while ($noticias->have_posts()): $noticias->the_post(); ?>
								
									<li>
										<h3 class="box-noticias__titulo"><?php the_title(); ?></h3>
										<p><?php the_excerpt(); ?></p>
										<div class="box-noticias__mais">
											<a href="<?php the_permalink(); ?>">Leia mais...</a>
										</div>
									</li>
								
								<?php endwhile; ?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	
</div>


<?php get_footer(); ?>