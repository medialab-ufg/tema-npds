<?php


class ListEventsShortcode {
    function __construct() {
        add_shortcode('list_events', array(&$this, 'shortcode'));
        add_action( 'wp_enqueue_scripts', array(&$this, 'addScripts') );
        add_action('wp_ajax_nopriv_list_events_shortcode', array(&$this, 'ajaxJS'));
        add_action('wp_ajax_list_events_shortcode', array(&$this, 'ajaxJS'));
    }

    function addScripts() {
        wp_enqueue_style('bootst', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/css/bootstrap.css');
        wp_enqueue_style('list-events-css-daterangepicker', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/css/daterangepicker.css');
        wp_enqueue_style('list-events-shortcode', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/css/list-events.css' );

        wp_enqueue_script('jquery');
        wp_enqueue_script('moment', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/js/moment.min.js');
        wp_enqueue_script('list-events-js-daterangepicker', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/js/daterangepicker.js');
        wp_enqueue_script('listevents-ajax-script', get_stylesheet_directory_uri() . '/inc/list-events-shortcode/js/app.js', array('jquery'));
    }


    function shortcode($atts, $content) {
        if (!is_array($atts) || !isset($atts['url']))
        return;

        $params = [
            '@files'     => '(header.header,avatar.avatarBig):url',
            '@select'    => 'name,shortDescription,occurrences.rule,occurrences.space.name,occurrences.space.endereco,occurrences.space.En_Municipio,occurrences.space.En_Estado&space',
            'space:type' => 'BET(20,29)'
        ];
		
		$defautls = [
			'title' => ''
		];
		
		$atts = array_merge($atts, $defautls);

        $url = add_query_arg($params, $atts['url'] . '/api/event/findByLocation');
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
