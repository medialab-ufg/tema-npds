<div class="content list_events">
	

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