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
	
		<div class="row justify-content-md-center">
			<div class="col-md-11">
				<div class="box-noticias">
					<div class="tainacan-title tainacan-title--type-c">
						<h2 class="title-1">Notícias <a class="extra-option" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Ver mais</a></h2>
					</div>

					<div class="row justify-content-center">
						<div class="col-lg-9">
							<div class="row justify-content-around">
								<div class="col-md-5">
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
			</div>
		</div>
		
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	
</div>


<?php get_footer(); ?>