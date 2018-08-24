<?php get_header(); ?>

<!-- Get the banner to display -->
<?php get_template_part( 'template-parts/bannerHeader' ); ?>
<!-- Get the menu if is create in panel admin -->
<?php get_template_part( 'template-parts/menuBellowBanner' ); ?>

<?php if ($post->post_parent > 0): ?>
	
	<?php $ancestors = get_post_ancestors(get_the_ID()); ?>
	
	<div class="row justify-content-center max-large px-4 px-md-0 no-gutters">
		<div class="col-md-11">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<?php foreach ($ancestors as $ancestor): ?>
						<li class="breadcrumb-item"><a href="<?php echo get_permalink($ancestor); ?>"><?php echo get_the_title($ancestor); ?></a></li>
					<?php endforeach; ?>
					<li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
				</ol>
			</nav>
		</div>
	</div>
<?php endif; ?>

<main role="main" class="mt-5 max-large px-4 px-md-0">
    <div class="row justify-content-md-center">
        <div class="col-md-11">
	       <?php get_template_part('template-parts/loop', 'singular'); ?>
        </div>
    </div>


    <div class="npds-list">
        <div class="row justify-content-md-center">
            <div class="col-md-11">

        <?php
            $children = get_children([
                'post_parent' => get_the_ID(),
                'post_type'   => 'npd', 
                'numberposts' => -1,
                ]);
        ?>

        <?php foreach($children as $child): ?>
                <div class="npds-list__item">
                    <div class="tainacan-title">
                        <div class="border-bottom mb-5 border-jelly-bean tainacan-title-page" style="border-width: 2px !important;">
                            <ul class="list-inline mb-1">
                                <li class="list-inline-item text-midnight-blue font-weight-bold title-page">
                                    <a href="<?php echo get_permalink($child->ID); ?>"><?php echo $child->post_title; ?></a>
                                </li>
                                <!-- <li class="list-inline-item float-right title-back"><a href="javascript:history.go(-1)"><?php _e('Back', 'tainacan-theme'); ?></a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-8">
                            <p><?php echo wp_trim_words($child->post_content, 60); ?></p>
                            <div class="npds-list__read-more">
                                <a href="<?php echo get_permalink($child->ID); ?>">Leia mais...</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
            </div>
        </div>
    </div>


    <?php if ($post->post_parent == 0): ?>
        <?php npds_the_events(); ?>

        <div class="row justify-content-md-center">
            <div class="col-md-11">
                <div class="box-contato">
                    <div class="tainacan-title">
                    <div class="border-bottom mb-5 border-jelly-bean tainacan-title-page" style="border-width: 2px !important;">
                        <ul class="list-inline mb-1">
                            <li class="list-inline-item text-midnight-blue font-weight-bold title-page">
                                Contato
                            </li>
                            <!-- <li class="list-inline-item float-right title-back"><a href="javascript:history.go(-1)"><?php _e('Back', 'tainacan-theme'); ?></a></li> -->
                        </ul>
                    </div>
                </div>

                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-8">
                            <div class="row justify-content-between">
                                <div class="col-md-5">
                                    <dl>
                                        <dt>Telefones</dt>
                                        <dd><?php echo get_post_meta(get_the_ID(), '_mapas_telefonePublico', true); ?></dd>

                                        <dt>Endereço</dt>
                                        <dd><?php echo get_post_meta(get_the_ID(), '_mapas_endereco', true); ?></dd>

                                        <dt>Correio Eletrônico</dt>
                                        <?php $linkEmail = get_post_meta(get_the_ID(), '_mapas_emailPublico', true); ?>
                                        <dd><a href="mailto:<?php echo $linkEmail; ?>"><?php echo $linkEmail; ?></a></dd>

                                        <dt>Blog</dt>
                                        <?php $linkBlog = get_post_meta(get_the_ID(), '_mapas_site', true); ?>
                                        <dd><a href="<?php echo $linkBlog; ?>"><?php echo $linkBlog; ?></a></dd>

                                        <dt>Facebook</dt>
                                        <?php $linkFace = get_post_meta(get_the_ID(), '_mapas_facebook', true); ?>
                                        <dd><a href="<?php echo $linkFace; ?>"><?php echo $linkFace; ?></a></dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="title-1 title-1--no-border">Mande sua mensagem</h3>
                                    <form class="form-style form-validar" action="#" method="post">
                                        <fieldset>
                                            <legend>Formulário de contato</legend>

                                            <div class="linha">
                                                <label for="contato-nome">Nome</label>
                                                <input type="text" id="contato-nome" class="obrigatorio">
                                            </div>

                                            <div class="linha">
                                                <label for="contato-email">E-mail</label>
                                                <input type="text" id="contato-email" class="obrigatorio-email">
                                            </div>

                                            <div class="linha">
                                                <label for="contato-assunto">Assunto</label>
                                                <input type="text" id="contato-assunto" class="obrigatorio">
                                            </div>

                                            <div class="linha">
                                                <label for="contato-mensagem">Escreva sua mensagem aqui.</label>
                                                <textarea id="contato-mensagem" cols="30" rows="10" class="obrigatorio"></textarea>
                                            </div>

                                            <div class="linha">
                                                <input type="submit" value="Enviar">
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>

<script>
    moverLabels();
    validarFormulario();
</script>
<?php get_footer(); ?>