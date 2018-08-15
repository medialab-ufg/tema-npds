<?php get_header(); ?>

<!-- Get the banner to display -->
<?php get_template_part( 'template-parts/bannerHeader' ); ?>
<!-- Get the menu if is create in panel admin -->
<?php get_template_part( 'template-parts/menuBellowBanner' ); ?>

<main role="main" class="mt-5 max-large px-4 px-md-0">
	<?php get_template_part('template-parts/loop', 'singular'); ?>


    <?php

        $children = get_children([
            'post_parent' => get_the_ID(),
            'post_type'   => 'npd', 
            'numberposts' => -1,
            ]);

    ?>

    <?php foreach($children as $child): ?>

        <div class="npds-list__item">
            <h2 class="title-1"><a href="<?php echo get_permalink($child->ID); ?>"><?php echo $child->post_title; ?></a></h2>
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <p><?php echo wp_trim_words($child->post_content, 60); ?></p>
                    <div class="npds-list__read-more">
                        <a href="<?php get_permalink($child->ID); ?>">Leia mais...</a>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>


    <?php npds_the_events(); ?>

</main>
<?php get_footer(); ?>