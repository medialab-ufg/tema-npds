<?php get_header(); ?>

<!-- Get the banner to display -->
<?php get_template_part( 'template-parts/bannerHeader' ); ?>
<!-- Get the menu if is create in panel admin -->
<?php get_template_part( 'template-parts/menuBellowBanner' ); ?>

<main role="main" class="mt-5 max-large px-4 px-md-0">
	<?php get_template_part('template-parts/loop', 'singular'); ?>


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
                    <h2 class="title-1"><a href="<?php echo get_permalink($child->ID); ?>"><?php echo $child->post_title; ?></a></h2>
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

        <div class="box-contato">
            <div class="tainacan-title">
                <h2 class="title-1">Contato</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
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
                            <form class="form-style" action="#" method="post">
                                <fieldset>
                                    <legend>Formulário de contato</legend>

                                    <div class="linha">
                                        <label for="">Nome</label>
                                        <input type="text" id="" class="">
                                    </div>

                                    <div class="linha">
                                        <label for="">E-mail</label>
                                        <input type="text" id="" class="">
                                    </div>

                                    <div class="linha">
                                        <label for="">Assunto</label>
                                        <input type="text" id="" class="">
                                    </div>

                                    <div class="linha">
                                        <label for="">Escreva sua mensagem aqui.</label>
                                        <textarea id="" class="" cols="30" rows="10"></textarea>
                                    </div>

                                    <div class="linha">
                                        <input type="submit" id="" class="" value="Enviar">
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>
<?php get_footer(); ?>