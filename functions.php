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
			'add_new_item' => 'Add New NPD',
			'edit_item' => 'Edit NPD',
			'all_items' => 'All NPDs',
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
}
add_action('init','new_post_types');

// Criando os meta boxes
function add_custom_meta_box() {
	add_meta_box( 'meta-box-mapas-culturais', 'Link para mapas culturais', 'add_meta_box_fields', 'NPD' );
}
add_action( 'add_meta_boxes', 'add_custom_meta_box' );

// Criando os campos dos meta boxes
function add_meta_box_fields( $post ) {
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

// Salvando os meta boxes
function save_meta_box_fields( $post_id ) {
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
		
		
		
		$current_value = get_post_meta($post_id, 'mapas_culturais', true);
		
		if ($_POST['mapas_culturais'] == $current_value) {
			return;
		}
		
		if ( preg_match_all('/^.+\/espaco\/(\d+)\/?$/', $_POST[ 'mapas_culturais' ], $m) ) {
			
			update_post_meta( $post_id, 'mapas_culturais', sanitize_text_field( $_POST[ 'mapas_culturais' ] ) );
			
			if (isset($m[1][0])) {
				$id = $m[1][0];
				
				$api_baseurl = 'http://mapas.cultura.gov.br/';
				$fields = [
					'id',
					'location',
					'name',
					'emailPublico',
					'emailPrivado',
					'telefonePublico',
					'endereco',
					'En_Municipio',
					'En_Estado',
					'site',
					'facebook',
					'twitter',
					'instagram'
				];
				
				$query_url = $api_baseurl . "api/space/find?id=EQ($id)&@select=" . implode(',', $fields);
				
				$query = wp_remote_get($query_url);
				
				if ( isset($query['body']) ) {
					
					$response = json_decode($query['body']);
					
					if (is_array($response) && isset($response[0]) && is_object($response[0])) {
						$response = $response[0];
					} else {
						return;
					}
					
					foreach ( $fields as $field ) {
						
						if (isset($response->$field)) {
							update_post_meta( $post_id, '_mapas_' . $field, $response->$field);
						}
						
					}
					
				}
				
				
				
			}
		}
		
		
	}
}
add_action( 'save_post', 'save_meta_box_fields' );

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

add_action('pre_get_posts', function($query) {

	if ($query->is_post_type_archive('npd') && $query->is_main_query()) {
		$query->set('post_parent', 0);
	}
});

require_once('inc/list-events-shortcode/listevents_shortcode.php');
require_once('inc/rewrite-rules.php');
