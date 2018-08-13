<div class="content list_events">
	<div class="row justify-content-md-center">
		<div class="col-md-11">
			<h2 class="title-1"><?= $atts['title']; ?><a class="extra-option" href="<?php echo site_url('/index.php/eventos'); ?>">Ver mais</a></h2>
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