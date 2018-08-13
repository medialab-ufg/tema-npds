<?php get_header(); ?>

<?php
	if ( have_posts() ) {
?>
		<div class="row justify-content-md-center">
			<div class="col-md-11">
				<div class="npds-list">

				<?php
				while ( have_posts() ) {
					the_post();
				?>
					<div class="npds-list__item">
						<h2 class="title-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><a class="extra-option" href="javascript:history.go(-1)">Voltar</a></h2>
						<div class="row justify-content-md-center">
							<div class="col-md-8">
								<p><?php echo wp_trim_words(get_the_content(), 60); ?></p>
								<div class="npds-list__read-more">
									<a href="<?php the_permalink(); ?>">Leia mais...</a>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>

				</div>
			</div>
		</div>
<?php
	}
?>

<?php get_footer(); ?>