<?php
    /* $bread = "<ol class='breadcrumb pb-0 mb-1' style='background: transparent'>";
    $bread .= "<li class='breadcrumb-item'><a href='#'>Home</a></li>";
    $bread .= "<li class='breadcrumb-item'><a href='#'>Site</a></li>";
    $bread .= "<li class='breadcrumb-item active' aria-current='page'>Blog</li>";
    $bread .= "</ol>"; */
?>
<?php if(has_nav_menu('navMenubelowHeader')) : ?>
    <nav class="navbar navbar-expand-lg menu-belowheader" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->	
        <a class="navbar-brand d-md-none" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menubelowHeader" aria-controls="menubelowHeader" aria-expanded="false" aria-label="Toggle navigation">	
            <i class="mdi mdi-menu"></i>
        </button>
        <div class="navigation-menu-wrapper">
            <h1 class="main-title"><a href="<?php echo get_home_url(); ?>" class="navbar-brand tainacan-logo" rel="home" itemprop="url"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/lgo/mhn.png'; ?>" class="logo" alt="Museu Histórico Nacional" title="Museu Histórico Nacional" itemprop="logo"></a></h1>
            <?php /* if(wp_is_mobile()) echo $bread; */ ?>
            <?php
                wp_nav_menu( array(
                    'theme_location'	=> 'navMenubelowHeader',
                    'depth'				=> 2, // 1 = with dropdowns, 0 = no dropdowns.
                    'container'			=> 'div',
                    'container_class'	=> 'collapse navbar-collapse',
                    'container_id'		=> 'menubelowHeader',
                    'menu_class'		=> 'navbar-nav',
                    'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
                    'walker'			=> new WP_Bootstrap_Navwalker()
                ) );
            ?>
        </div>
    </nav>
<?php endif; ?>
<!-- <nav aria-label="breadcrumb" class="d-none d-md-flex">
    <?php //echo $bread; ?>
</nav> -->