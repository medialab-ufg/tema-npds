<?php get_header(); ?>

<?php
	if ( have_posts() ) {
?>
		<div class="row justify-content-md-center">
			<div class="col-md-11">
				<div class="tainacan-title">
					<h2 class="title-1">Banco de profissionais</h2>
				</div>
				<div class="header-meta text-muted post-details tainacan-details">
					Atualizado em <?php tainacan_post_date(); ?>.
				</div>
			</div>
		</div>

		<div class="row justify-content-md-center">
			<div class="col-md-9">
				<div class="lista-profissionais">
					<div class="row justify-content-between">
						<?php
						$i = 1;
						while ( have_posts() ) {
							the_post();
						?>
								<div class="col-md-6">
									<div class="lista-profissionais__item">
										<div class="lista-profissionais__imagem">
											<img src="" alt="">
										</div>
										<div class="lista-profissionais__texto">
											<?php
												$terms = get_the_terms( $post->ID, 'type_area' );
												if(!empty($terms)) {
													$output = array();
													foreach ($terms as $term) {
														$output[] = $term->name;
													}
											?>

											<span class="lista-profissionais__categoria"><?php echo join( ', ', $output ); ?></span>

											<?php
												}
											?>

											<strong class="lista-profissionais__nome"><?php the_title(); ?></strong>

											<?php
												$terms = get_the_terms( $post->ID, 'type_especialidade' );
												if(!empty($terms)) {
													$output = array();
													foreach ($terms as $term) {
														$output[] = $term->name;
													}
											?>

												<span class="lista-profissionais__dado"><b>Especialidades:</b> 
													<?php echo join( ', ', $output ); ?>
												</span>

											<?php
												}
											?>

											<span class="lista-profissionais__dado"><b>Cidade:</b> <?php echo get_post_meta($post->ID, 'profissionais_cidade', true); ?> - <?php echo get_post_meta($post->ID, 'profissionais_estado', true); ?></span>
											<span class="lista-profissionais__dado"><b>Telefone:</b> <?php echo get_post_meta($post->ID, 'profissionais_telefone', true); ?></span>
											<span class="lista-profissionais__dado"><b>E-mail:</b> <?php echo get_post_meta($post->ID, 'profissionais_email', true); ?></span>
										</div>
									</div>
								</div>
						<?php
							if ($i % 2 == 0) {
						?>
								</div>
								<div class="row justify-content-between">

						<?php
							}
							$i++;
						}
						?>
					</div>

					<div class="paginacao-tainacan">
						<?php echo tainacan_pagination(3); ?>
					</div>
				</div>
			</div>
		</div>
<?php
	}
?>

<?php get_footer(); ?>

<?php /*the_time('F jS, Y') ?></strong> by <?php the_author_posts_link() */?>
