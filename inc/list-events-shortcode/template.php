<div class="content list_events">
	<div class="npds-list">
		<?php
			$npdList = new WP_Query(array(
				'post_type' => 'NPD'
			));
			while($npdList -> have_posts()) {
				$npdList -> the_post();
		?>

		<div class="npds-list__item">
			<h2 class="title-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<div class="row">
				<div class="col-md-8 col-md-offset-2">
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

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="filter-box">
				<h3><?= $atts['title']; ?></h3>
				<div id="date_listevents" data-range="<?= $dataRange; ?>" data-baseurl="<?= $atts['url']; ?>" data-url="<?= $url; ?>">
					<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
					<span></span> <b class="caret"></b>
				</div>
			</div>

			<div id="loading" class="spinner" style="display:none;">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>

			<div class="list_spaces"></div>
		</div>
	</div>
</div>