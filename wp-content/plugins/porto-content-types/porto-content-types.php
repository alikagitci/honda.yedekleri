<?php
/*
Plugin Name: Porto Content Types
Plugin URI: http://themeforest.net/user/SW-THEMES
Description: Content Types for Porto eCommerce Theme.
Version: 1.0.0
Author: SW-THEMES
Author URI: http://themeforest.net/user/SW-THEMES
*/

// don't load directly
if (!defined('ABSPATH'))
    die('-1');

define('PORTO_CONTENT_TYPES_PATH', dirname(__FILE__) . '/content-types/');

class PortoContentTypesClass {

    function __construct() {

        // Load text domain
        add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ) );

        // Register content types
        add_action('init', array( $this, 'addBlockContentType' ) );
        add_action('init', array( $this, 'addFaqContentType' ) );
        add_action('init', array( $this, 'addMemberContentType' ) );
        add_action('init', array( $this, 'addPortfolioContentType' ) );
    }

    // Init plugins
    function initPlugin() {

    }

    // Register block content type
    function addBlockContentType() {
        register_post_type(
            'block',
            array(
                'labels' => $this->getLabels(__('Block', 'porto'), __('Blocks', 'porto')),
                'exclude_from_search' => true,
                'has_archive' => false,
                'public' => true,
                'rewrite' => array('slug' => 'block'),
                'supports' => array('title', 'editor'),
                'can_export' => true
            )
        );
    }

    // Register portfolio content type
    function addPortfolioContentType() {
        register_post_type(
            'portfolio',
            array(
                'labels' => $this->getLabels(__('Portfolio', 'porto'), __('Portfolios', 'porto')),
                'exclude_from_search' => false,
                'has_archive' => true,
                'public' => true,
                'rewrite' => array('slug' => 'portfolio'),
                'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes'),
                'can_export' => true
            )
        );

        register_taxonomy(
            'portfolio_cat',
            'portfolio',
            array(
                'hierarchical' => true,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels(__('Portfolio Category', 'porto'), __('Portfolio Categories', 'porto')),
                'query_var' => true,
                'rewrite' => true
            )
        );

        register_taxonomy(
            'portfolio_skills',
            'portfolio',
            array(
                'hierarchical' => false,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels(__('Portfolio Skill', 'porto'), __('Portfolio Skills', 'porto')),
                'query_var' => true,
                'rewrite' => true
            )
        );
    }

    // Register faq content type
    function addFaqContentType() {
        register_post_type(
            'faq',
            array(
                'labels' => $this->getLabels(__('FAQ', 'porto'), __('FAQs', 'porto')),
                'exclude_from_search' => false,
                'has_archive' => true,
                'public' => true,
                'rewrite' => array('slug' => 'faq'),
                'supports' => array('title', 'editor'),
                'can_export' => true
            )
        );

        register_taxonomy(
            'faq_cat',
            'faq',
            array(
                'hierarchical' => true,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels(__('FAQ Category', 'porto'), __('FAQ Categories', 'porto')),
                'query_var' => true,
                'rewrite' => true
            )
        );
    }

    // Register member content type
    function addMemberContentType() {
        register_post_type(
            'member',
            array(
                'labels' => $this->getLabels(__('Member', 'porto'), __('Members', 'porto')),
                'exclude_from_search' => false,
                'has_archive' => true,
                'public' => true,
                'rewrite' => array('slug' => 'member'),
                'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes'),
                'can_export' => true
            )
        );

        register_taxonomy(
            'member_cat',
            'member',
            array(
                'hierarchical' => true,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels(__('Member Category', 'porto'), __('Member Categories', 'porto')),
                'query_var' => true,
                'rewrite' => true
            )
        );
    }

    // load plugin text domain
    function loadTextDomain() {
        load_plugin_textdomain( 'porto', false, dirname( __FILE__ ) . '/languages/' );
    }

    // Get content type labels
    function getLabels($singular_name, $name, $title = FALSE) {
        if( !$title )
            $title = $name;

        return array(
            "name" => $title,
            "singular_name" => $singular_name,
            "add_new" => __("Add New", 'porto'),
            "add_new_item" => sprintf( __("Add New %s", 'porto'), $singular_name),
            "edit_item" => sprintf( __("Edit %s", 'porto'), $singular_name),
            "new_item" => sprintf( __("New %s", 'porto'), $singular_name),
            "view_item" => sprintf( __("View %s", 'porto'), $singular_name),
            "search_items" => sprintf( __("Search %s", 'porto'), $name),
            "not_found" => sprintf( __("No %s found", 'porto'), $name),
            "not_found_in_trash" => sprintf( __("No %s found in Trash", 'porto'), $name),
            "parent_item_colon" => ""
        );
    }

    // Get content type taxonomy labels
    function getTaxonomyLabels($singular_name, $name) {
        return array(
            "name" => $name,
            "singular_name" => $singular_name,
            "search_items" => sprintf( __("Search %s", 'porto'), $name),
            "all_items" => sprintf( __("All %s", 'porto'), $name),
            "parent_item" => sprintf( __("Parent %s", 'porto'), $singular_name),
            "parent_item_colon" => sprintf( __("Parent %s:", 'porto'), $singular_name),
            "edit_item" => sprintf( __("Edit %", 'porto'), $singular_name),
            "update_item" => sprintf( __("Update %s", 'porto'), $singular_name),
            "add_new_item" => sprintf( __("Add New %s", 'porto'), $singular_name),
            "new_item_name" => sprintf( __("New %s Name", 'porto'), $singular_name),
            "menu_name" => $name,
        );
    }
}

// Finally initialize code
new PortoContentTypesClass();
