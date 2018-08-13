<?php if(have_posts()): ?>
	<?php while(have_posts()): the_post(); ?>
		<div class="tainacan-title">
			<h2 class="title-1"><?php the_title(); ?><a class="extra-option" href="javascript:history.go(-1)"><?php _e('Voltar'); ?></a></h2>
		</div>
		<div class="mt-3 tainacan-single-post">
			<?php get_template_part('template-parts/single-post'); ?>
		</div>
	<?php endwhile; ?>
<?php else: ?>
	<?php _e('Nothing found', 'tainacan-theme'); ?>
<?php endif; ?>