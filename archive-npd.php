<?php get_header(); ?>

<?php
	if ( have_posts() ) {
?>
		<div class="row justify-content-md-center">
			<div class="col-md-11">
				<div class="npds-list">

				<?php
				$current_city = '';
				while ( have_posts() ) {
					the_post();
					$cidade = get_post_meta(get_the_ID(), '_mapas_En_Municipio', true);
					$estado = get_post_meta(get_the_ID(), '_mapas_En_Estado', true);
					$endereco = get_post_meta(get_the_ID(), '_mapas_endereco', true);
					$coordendas = get_post_meta(get_the_ID(), '_mapas_location', true);
					
				?>
					
					<?php if ( $current_city != $cidade ): $current_city = $cidade ?>
						<h2><?php echo $cidade; ?> - <?php echo $estado; ?></h2>
					<?php endif; ?>
					<br/>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
					::
					<?php echo $endereco; ?>
					<br/>
					lat: <?php echo $coordendas->latitude; ?>
					long: <?php echo $coordendas->longitude; ?>
					
					<!--
					<div class="npds-list__item jlk">
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
					-->
				<?php
				}
				?>

				</div>

				<div class="paginacao-tainacan">
					<?php echo tainacan_pagination(3); ?>
				</div>
			</div>
		</div>
<?php
	}
?>

<?php get_footer(); ?>