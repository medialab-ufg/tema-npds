<?php get_header(); ?>

<!-- Get the banner to display -->
<?php get_template_part( 'template-parts/bannerHeader' ); ?>
<!-- Get the menu if is create in panel admin -->
<?php get_template_part( 'template-parts/menubellowbanner' ); ?>

<main role="main" class="mt-5 max-large px-4 px-md-0">
<?php
	if ( have_posts() ) {
?>
	<div class="row justify-content-md-center">
		<div class="col-md-11">
			<div class="tainacan-title">
				<div class="border-bottom mb-5 border-jelly-bean tainacan-title-page" style="border-width: 2px !important;">
					<ul class="list-inline mb-1">
						<li class="list-inline-item text-midnight-blue font-weight-bold title-page">
							NPDs no mapa - Localização
						</li>
						<!-- <li class="list-inline-item float-right title-back"><a href="javascript:history.go(-1)"><?php _e('Back', 'tainacan-theme'); ?></a></li> -->
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="row justify-content-md-center">
		<div class="col-md-9">
			<ul class="npds-mapas">

			<?php
			$contador = 0;
			$current_city = '';
			while ( have_posts() ) {
				the_post();
				$cidade = get_post_meta(get_the_ID(), '_mapas_En_Municipio', true);
				$estado = get_post_meta(get_the_ID(), '_mapas_En_Estado', true);
				$endereco = get_post_meta(get_the_ID(), '_mapas_endereco', true);
				$coordendas = get_post_meta(get_the_ID(), '_mapas_location', true);
				
			?>
				<li>
					<?php if ( $current_city != $cidade ): $current_city = $cidade ?>
						<button class="mapas-cidade dropdown-toggle" type="button"><?php echo $cidade; ?> - <?php echo $estado; ?></button>
					<?php endif; ?>

					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-11">
							<div class="mapas-box">
								<span class="mapas-detalhes"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php echo $endereco; ?></span>

								<div id="map-<?php echo $contador; ?>" class="mapas-map"></div>

								<script>
									function initMap() {
										var pin = {lat: <?php echo $coordendas->latitude; ?>, lng: <?php echo $coordendas->longitude; ?>};
										var map = new google.maps.Map(
										document.getElementById('map-<?php echo $contador; ?>'), {zoom: 16, center: pin});
										var marker = new google.maps.Marker({position: pin, map: map});
									}
								</script>
							</div>
						</div>
					</div>
				</li>
			<?php
				$contador++;
			}
			?>

			</ul>

			<div class="paginacao-tainacan">
				<?php echo tainacan_pagination(3); ?>
			</div>
		</div>
	</div>
<?php
	}
?>
</main>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQoHRJXCY1S8TNTuoXT6yhVUtRisW6gK8&callback=initMap"></script>

<script>
	exibirMapa();
</script>

<?php get_footer(); ?>