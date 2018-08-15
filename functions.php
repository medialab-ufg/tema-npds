<?php

// Estilos
function theme_enqueue_styles() {

	$parent_style = 'parent-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style )
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// Criando novos post types
function new_post_types() {
	register_post_type('NPD',array(
		'public' => true,
		'labels' => array(
			'name' => 'NPDs',
			'add_new' => 'Adicionar novo NPD',
			'edit_item' => 'Editar NPD',
			'all_items' => 'Todos os NPDs',
			'singular_name' => 'NPD'
		),
		'show_in_rest' => true,
		'supports' => [
			'editor',
			'title',
			'page-attributes'
		],
		'menu_icon' => 'dashicons-align-left',
		'hierarchical' => true,
		'has_archive' => true
	));

	register_post_type('profissional',array(
		'public' => true,
		'labels' => array(
			'name' => 'Profissionais',
			'add_new' => 'Adicionar Novo Profissional',
			'edit_item' => 'Editar Profissional',
			'all_items' => 'Todos os profissionais',
			'singular_name' => 'Profissional'
		),
		'show_in_rest' => true,
		'supports' => [
			'title',
			'page-attributes'
		],
		'menu_icon' => 'dashicons-groups',
		'has_archive' => true
	));
}
add_action('init','new_post_types');

// Criando os meta boxes
function add_custom_meta_box() {
	add_meta_box( 'meta-box-mapas-culturais', 'Link para mapas culturais', 'add_meta_box_npd', 'NPD' );
	add_meta_box( 'meta-box-profissionais', 'Dados complementares', 'add_meta_box_profissionais', 'profissional' );
}
add_action( 'add_meta_boxes', 'add_custom_meta_box' );

// Criando os campos dos meta boxes
function add_meta_box_npd( $post ) {
	$mapas_culturais     = get_post_custom( $post -> ID );
	$mapas_culturais_box = isset( $mapas_culturais[ 'mapas_culturais' ] ) ? esc_attr( $mapas_culturais[ 'mapas_culturais' ][ 0 ] ) : '';

	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>

	<p>
		<label for="mapas_culturais">
			Link para página do NPD na plataforma Mapas Culturais. (ex: http://mapas.cultura.gov.br/espaco/1234)
		</label>
		<input type="text" class="widefat" name="mapas_culturais" id="mapas_culturais" value="<?php echo $mapas_culturais_box; ?>"/>
	</p>
	<?php
}

function add_meta_box_profissionais( $post ) {
	$profissionais              = get_post_custom( $post -> ID );
	$profissionais_cidade_box   = isset( $profissionais[ 'profissionais_cidade' ] ) ? esc_attr( $profissionais[ 'profissionais_cidade' ][ 0 ] ) : '';
	$profissionais_estado_box   = isset( $profissionais[ 'profissionais_estado' ] ) ? esc_attr( $profissionais[ 'profissionais_estado' ][ 0 ] ) : '';
	$profissionais_telefone_box = isset( $profissionais[ 'profissionais_telefone' ] ) ? esc_attr( $profissionais[ 'profissionais_telefone' ][ 0 ] ) : '';
	$profissionais_email_box    = isset( $profissionais[ 'profissionais_email' ] ) ? esc_attr( $profissionais[ 'profissionais_email' ][ 0 ] ) : '';

	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>

	<p>
		<label for="profissionais_cidade">Cidade</label>
		<input type="text" class="widefat" name="profissionais_cidade" id="profissionais_cidade" value="<?php echo $profissionais_cidade_box; ?>"/>
	</p>
	<p>
		<label for="profissionais_estado">Estado</label>
		<input type="text" class="widefat" name="profissionais_estado" id="profissionais_estado" value="<?php echo $profissionais_estado_box; ?>"/>
	</p>
	<p>
		<label for="profissionais_telefone">Telefone</label>
		<input type="text" class="widefat" name="profissionais_telefone" id="profissionais_telefone" value="<?php echo $profissionais_telefone_box; ?>"/>
	</p>
	<p>
		<label for="profissionais_email">E-mail</label>
		<input type="text" class="widefat" name="profissionais_email" id="profissionais_email" value="<?php echo $profissionais_email_box; ?>"/>
	</p>
	<?php
}

// Salvando os meta boxes
function save_meta_box_npd( $post_id ) {
	// Return/Bail out if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Checking if the nonce isn't there, or we can't verify it, then we should return
	if ( ! isset( $_POST[ 'meta_box_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'meta_box_nonce' ], 'my_meta_box_nonce' ) ) {
		return;
	}

	// Checking if the current user can't edit this post, then we should return
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}

	// Saving the data in meta box
	// Saving the team designation in the meta box
	if ( isset( $_POST[ 'mapas_culturais' ] ) ) {
		update_post_meta( $post_id, 'mapas_culturais', sanitize_text_field( $_POST[ 'mapas_culturais' ] ) );
	}
}
add_action( 'save_post', 'save_meta_box_npd' );

// Salvando os meta boxes
function save_meta_box_profissional( $post_id ) {
	// Return/Bail out if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Checking if the nonce isn't there, or we can't verify it, then we should return
	if ( ! isset( $_POST[ 'meta_box_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'meta_box_nonce' ], 'my_meta_box_nonce' ) ) {
		return;
	}

	// Checking if the current user can't edit this post, then we should return
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}

	// Saving the data in meta box
	// Saving the team designation in the meta box
	if ( isset( $_POST[ 'profissionais_cidade' ] ) ) {
		update_post_meta( $post_id, 'profissionais_cidade', sanitize_text_field( $_POST[ 'profissionais_cidade' ] ) );
	}
	if ( isset( $_POST[ 'profissionais_estado' ] ) ) {
		update_post_meta( $post_id, 'profissionais_estado', sanitize_text_field( $_POST[ 'profissionais_estado' ] ) );
	}
	if ( isset( $_POST[ 'profissionais_telefone' ] ) ) {
		update_post_meta( $post_id, 'profissionais_telefone', sanitize_text_field( $_POST[ 'profissionais_telefone' ] ) );
	}
	if ( isset( $_POST[ 'profissionais_email' ] ) ) {
		update_post_meta( $post_id, 'profissionais_email', sanitize_text_field( $_POST[ 'profissionais_email' ] ) );
	}
}
add_action( 'save_post', 'save_meta_box_profissional' );

/*
 * Taxonomia
*/

function create_taxonomy_type() {
	register_taxonomy(
		'type_area',
		'profissional',
		array(
			'labels' => array(
				'name' => 'Área',
				'add_new_item' => 'Adicionar Nova Área',
				'edit_item' => 'Editar Área',
				'all_items' => 'Todas as Áreas',
				'singular_name' => 'Área'
			),
			'rewrite' => array( 'slug' => 'area' ),
			'hierarchical' => true,
		)
	);
	register_taxonomy(
		'type_especialidade',
		'profissional',
		array(
			'labels' => array(
				'name' => 'Especialidades',
				'add_new_item' => 'Adicionar Nova Especialidade',
				'edit_item' => 'Editar Especialidade',
				'all_items' => 'Todas as Especialidades',
				'singular_name' => 'Especialidade'
			),
			'rewrite' => array( 'slug' => 'especialidade' ),
			'hierarchical' => true,
		)
	);
}
add_action( 'init', 'create_taxonomy_type' );

/**
 * Para usar dentro do loop do post type NPDs ou em uma single de NPG
 * Imprime a lista de eventos, conseguidas através dos Mapas Culturais
 * do NPD atual, desde que ele tenha o metadado do Mapas Culturais preenchido e válido 
 * 
 */
function npds_the_events() {

	$post = get_post();
	
	if (!$post || !isset($post->post_type) || 'npd' != $post->post_type) {
		return;
	}
	
	$mapas_url = get_post_meta($post->ID, 'mapas_culturais', true);
	
	if ( preg_match_all('/^.+\/espaco\/(\d+)\/?$/', $mapas_url, $m) ) {
		
		if (isset($m[1][0])) {
			$id = $m[1][0];
			echo do_shortcode('[list_events url=http://museus.cultura.gov.br space=' . $id . ']');
		}
	}
}

/**
 * Imprime a lista de todos os eventos, conseguidas através dos Mapas Culturais
 * 
 */
function npds_all_events() {
	echo do_shortcode('[list_events url=http://museus.cultura.gov.br]');
}

require_once('inc/list-events-shortcode/listevents_shortcode.php');
require_once('inc/rewrite-rules.php');
