<article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
    <header>
        <div class="header-meta text-muted post-details">
            <?php tainacan_post_date(); ?> <?php printf(__('por %s', 'tainacan-theme'), get_the_author_posts_link()); ?>
        </div>
        <?php the_post_thumbnail(); ?>
    </header>
    <section class="tainacan-content text-black margin-two-column">
        <?php
            the_content();
            wp_link_pages();
        ?>
    </section>
</article>
<div class="row">
	<!-- Container -->
	<div class="col mx-auto">
        <?php
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif; ?>
    </div>
</div>