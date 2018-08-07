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
		'menu_icon' => 'dashicons-align-left'
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
		update_post_meta( $post_id, 'mapas_culturais', sanitize_text_field( $_POST[ 'mapas_culturais' ] ) );
	}
}
add_action( 'save_post', 'save_meta_box_fields' );