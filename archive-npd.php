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
</main>

<?php get_footer(); ?>