<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
        
    <nav class="navbar navbar-expand-md navbar-light bg-white menu-shadow px-0">
        <div class="container-fluid max-large px-0 margin-one-column" id="topNavbar">
            <?php echo tainacan_get_logo(); ?>

            <div class="navbar-box">
				<?php if ( has_nav_menu( 'navMenubelowHeader' ) ) : ?>
					<nav class="navbar navbar-expand-md navbar-light px-0 menu-belowheader" role="navigation">
						<div class="container-fluid max-large px-0 margin-one-column">
							<!-- Brand and toggle get grouped for better mobile display -->	
							<!-- <a class="navbar-brand d-md-none" href="#"></a> -->
							<button class="navbar-toggler text-heavy-metal border-0 px-2 pt-2 collapsed" type="button" data-toggle="collapse" data-target="#menubelowHeader" aria-controls="menubelowHeader" aria-expanded="false" aria-label="Toggle navigation">
								<span class="tainacan-icon tainacan-icon-menu"></span>
								<span class="tainacan-icon tainacan-icon-close"></span>
							</button>
							<?php
								wp_nav_menu( array(
									'theme_location'  => 'navMenubelowHeader',
									'container'       => 'div',
									'container_class' => 'collapse navbar-collapse',
									'container_id'    => 'menubelowHeader',
									'menu_class'      => 'navbar-nav mr-auto',
									'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
									'walker'          => new WP_Bootstrap_Navwalker(),
								) );
							?>
						</div>
					</nav>
				<?php endif; ?>

				<div class="btn-group">
					<form class="form-horizontal my-2 my-md-0 tainacan-search-form d-none d-md-block" [formGroup]="searchForm" role="form" (keyup.enter)="onSubmit()" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<div class="input-group">
							<input type="text" name="s" placeholder="<?php esc_attr_e( 'Search', 'tainacan-interface' ); ?>" class="form-control" formControlName="searchText" size="50">
							<span class="text-midnight-blue input-group-btn tainacan-icon tainacan-icon-search form-control-feedback"></span>
						</div>
					</form>
					<div class="dropdown tainacan-form-dropdown d-md-none">
						<a class="btn btn-link text-midnight-blue px-1 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="tainacan-icon tainacan-icon-search"></i><i class="tainacan-icon tainacan-icon-close"></i></a>

						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div>
			</div>
        </div>
    </nav>