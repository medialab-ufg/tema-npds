<?php get_header(); ?>

<!-- Get the banner to display -->
<?php get_template_part( 'template-parts/bannerHeader' ); ?>
<!-- Get the menu if is create in panel admin -->
<?php get_template_part( 'template-parts/menuBellowBanner' ); ?>

<?php if ($post->post_parent > 0): ?>
	
	<?php $ancestors = get_post_ancestors(get_the_ID()); ?>
	
	<div class="row justify-content-center max-large px-4 px-md-0 no-gutters">
		<div class="col-md-11">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<?php foreach ($ancestors as $ancestor): ?>
						<li class="breadcrumb-item"><a href="<?php echo get_permalink($ancestor); ?>"><?php echo get_the_title($ancestor); ?></a></li>
					<?php endforeach; ?>
					<li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
				</ol>
			</nav>
		</div>
	</div>
<?php endif; ?>

<main role="main" class="mt-5 max-large px-4 px-md-0">
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
											<?php if ( has_post_thumbnail() ) {
												the_post_thumbnail();
											} else { ?>
												<img src="<?php echo get_theme_file_uri('/assets/images/perfil.png') ?>" alt="<?php the_title(); ?>">
											<?php } ?>
										</div>
										<div class="lista-profissionais__texto">
											<span class="lista-profissionais__categoria"><?php the_terms( $post->ID, 'type-area', '', ', ', ' ' );?></span>
											<strong class="lista-profissionais__nome"><?php the_title(); ?></strong>
											<span class="lista-profissionais__dado"><?php the_terms( $post->ID, 'type_especialidade', '<b>Especialidades:</b> ', ', ', ' ' );?></span>
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
</main>

<?php get_footer(); ?>
