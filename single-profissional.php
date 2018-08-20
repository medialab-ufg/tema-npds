<?php get_header(); ?>

<!-- Get the banner to display -->
<?php get_template_part( 'template-parts/bannerHeader' ); ?>
<!-- Get the menu if is create in panel admin -->
<?php get_template_part( 'template-parts/menuBellowBanner' ); ?>

<main role="main" class="mt-5 max-large px-4 px-md-0">
	<div class="row justify-content-md-center">
		<div class="col-md-11">
			<div class="tainacan-title">
				<h2 class="title-1"><?php the_title(); ?><a class="extra-option" href="javascript:history.go(-1)"><?php _e('Voltar'); ?></a></h2>
			</div>

			<div class="header-meta text-muted post-details tainacan-details">
				<?php tainacan_post_date(); ?> <?php printf(__('por %s', 'tainacan-theme'), get_the_author_posts_link()); ?>
			</div>
		</div>
	</div>

	<div class="row justify-content-md-center">
		<div class="col-md-8">
			<div class="lista-profissionais">
				<div class="lista-profissionais__item">
					<div class="lista-profissionais__imagem">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						} ?>
					</div>
					<div class="lista-profissionais__texto">
						<span class="lista-profissionais__categoria"><?php the_terms( $post->ID, 'area_profissional', '', ', ', ' ' );?></span>
						<strong class="lista-profissionais__nome"><?php the_title(); ?></strong>
						<span class="lista-profissionais__dado"><?php the_terms( $post->ID, 'especialidade_profissional', '<b>Especialidades:</b> ', ', ', ' ' );?></span>
						<span class="lista-profissionais__dado"><b>Cidade:</b> <?php echo get_post_meta($post->ID, 'profissionais_cidade', true); ?> - <?php echo get_post_meta($post->ID, 'profissionais_estado', true); ?></span>
						<span class="lista-profissionais__dado"><b>Telefone:</b> <?php echo get_post_meta($post->ID, 'profissionais_telefone', true); ?></span>
						<span class="lista-profissionais__dado"><b>E-mail:</b> <?php echo get_post_meta($post->ID, 'profissionais_email', true); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>