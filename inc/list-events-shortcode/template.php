<div class="content list_events">
	<div class="row justify-content-md-center">
		<div class="col-md-11">
			<div class="tainacan-title">
				<div class="border-bottom mb-5 border-jelly-bean tainacan-title-page" style="border-width: 2px !important;">
					<ul class="list-inline mb-1">
						<li class="list-inline-item text-midnight-blue font-weight-bold title-page">
							<?= $atts['title']; ?>
						</li>
						<?php if (is_single() && !get_query_var('npds_tpl')): ?>
							<li class="list-inline-item float-right title-back"><a href="<?php the_permalink(); ?>/eventos"><?php _e('Read more', 'tainacan-theme'); ?></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="row justify-content-md-center">
		<div class="col-md-8">
			<div class="filter-box">
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