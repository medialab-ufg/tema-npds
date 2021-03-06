<?php


class ListEventsShortcode {
    function __construct() {
        add_shortcode('list_events', array(&$this, 'shortcode'));
        add_action( 'wp_enqueue_scripts', array(&$this, 'addScripts') );
        add_action('wp_ajax_nopriv_list_events_shortcode', array(&$this, 'ajaxJS'));
        add_action('wp_ajax_list_events_shortcode', array(&$this, 'ajaxJS'));
    }

    function addScripts() {
        
        wp_enqueue_style('list-events-css-daterangepicker', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/css/daterangepicker.css');
        wp_enqueue_style('glyphicons-list', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/css/glyphicons.css' );
        wp_enqueue_style('new-list-events-shortcode', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/css/new-list-events.css' );

        if (is_singular('npd') || get_query_var('npds_tpl')) {
    
            wp_enqueue_script('jquery');
            wp_enqueue_script('moment', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/js/moment.min.js');
            wp_enqueue_script('list-events-js-daterangepicker', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/js/daterangepicker.js');
            wp_enqueue_script('listevents-ajax-script', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/js/app.js', array('jquery'));
        }
        
    }


    function shortcode($atts, $content) {
        if (!is_array($atts) || !isset($atts['url']))
        return;

        $params = [
            '@files'     => '(header.header,avatar.avatarBig):url',
            '@select'    => 'name,shortDescription,occurrences.rule,occurrences.space.name,occurrences.space.endereco,occurrences.space.En_Municipio,occurrences.space.En_Estado',
            'space:type' => 'BET(20,29)'
        ];
		
		if (isset($atts['space']) && is_numeric($atts['space'])) {
			$params['space'] = 'EQ(' . $atts['space'] . ')';
		}
		
		$defautls = [
			'title' => 'Eventos'
		];
		
		$atts = array_merge($atts, $defautls);

        $url = add_query_arg($params, $atts['url'] . '/api/event/findByLocation');
		//var_dump($url); 
        $dataRange = 30;
        if (isset($atts['date_range'])) {
            $dataRange   = $atts['date_range'];
        }

        ob_start();
        include('template.php');
        $html = ob_get_clean();
        return $html;
    }
}

add_action('init', function() {
    $ListEventsShortcode = new ListEventsShortcode;
});
