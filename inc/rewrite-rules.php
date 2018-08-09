<?php

class NPDRewriteRules {

    private static $instance;
    const EVENTS_URL = 'eventos';

    function __construct() {
            add_action( 'generate_rewrite_rules', array( &$this, 'rewrite_rules' ), 10, 1 );
            add_filter( 'query_vars', array( &$this, 'rewrite_rules_query_vars' ) );
            add_filter( 'template_include', array( &$this, 'rewrite_rule_template_include' ) );
    }


    function rewrite_rules( &$wp_rewrite ) {
        
        $new_rules = array(
            self::EVENTS_URL . "/?$"             => "index.php?npds_tpl=eventos",
			"npd/([^/]+)/" . self::EVENTS_URL . "/?$"             => 'index.php?npd=$matches[1]&npds_tpl=eventos',
        );
        

        $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;

        //var_dump($wp_rewrite); die;
    }

    function rewrite_rules_query_vars( $public_query_vars ) {

        $public_query_vars[] = "npds_tpl";

        return $public_query_vars;

    }

    function rewrite_rule_template_include( $template ) {
        global $wp_query;

        if ( $wp_query->get( 'npds_tpl' ) ) {

            if ( file_exists( STYLESHEETPATH . '/' . $wp_query->get( 'npds_tpl' ) . '.php' ) ) {
                return STYLESHEETPATH . '/' . $wp_query->get( 'npds_tpl' ) . '.php';
            }

        }

        return $template;


    }

}

global $NPDRewriteRules;
$NPDRewriteRules = new NPDRewriteRules();
