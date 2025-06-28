<?php

/**
 * LeanLogicSite class
 * This class is used to add custom functionality to the theme.
 */

namespace LeanLogic;

use Timber\Site;
use Timber\Timber;
use Twig\Environment;
use Twig\TwigFilter;

class LeanLogicSite extends Site {

    public function __construct() {
        add_action( 'after_setup_theme', [ $this, 'theme_supports' ] );
        add_action( 'init', [ $this, 'register_post_types' ] );
        add_action( 'init', [ $this, 'register_taxonomies' ] );

        add_filter( 'timber/context', [ $this, 'add_to_context' ] );
        add_filter( 'timber/twig/filters', [ $this, 'add_filters_to_twig' ] );
        add_filter( 'timber/twig/functions', [ $this, 'add_functions_to_twig' ] );
        add_filter( 'timber/twig/environment/options', [ $this, 'update_twig_environment_options' ] );

        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_component_scripts' ] );

        $this->load_components();

        parent::__construct();
    }

    public function register_post_types() {}

    public function register_taxonomies() {}

    public function add_to_context( $context ) {
        $context['foo']          = 'bar';
        $context['stuff']        = 'I am a value set in your functions.php file';
        $context['notes']        = 'These values are available everytime you call Timber::context();';
        $context['menu']         = Timber::get_menu( 'primary_navigation' );
        $context['site']         = $this;
        $context['dark_mode']    = isset($_COOKIE['dark']) && $_COOKIE['dark'] === 'true';
        return $context;
    }

    public function theme_supports() {
        register_nav_menus(
            [
                'primary_navigation' => _x( 'Main menu', 'Backend - menu name', 'timber-starter' ),
            ]
        );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support(
            'html5',
            [
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        );
        add_theme_support(
            'post-formats',
            [
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'audio',
            ]
        );
        add_theme_support( 'menus' );
        add_theme_support( 'editor-styles' );
    }

    public function myfoo( $text ) {
        return $text . ' bar!';
    }

    public function add_filters_to_twig( $filters ) {
        $additional_filters = [
            'myfoo' => [
                'callable' => [ $this, 'myfoo' ],
            ],
            'append_version' => [
                'callable' => function ( $asset ) {
                    return $asset . '?v=' . filemtime( get_template_directory() . '/' . $asset );
                }
            ]
        ];

        return array_merge( $filters, $additional_filters );
    }

    public function add_functions_to_twig( $functions ) {
        $additional_functions = [
            'get_theme_mod' => [
                'callable' => 'get_theme_mod',
            ],
        ];

        return array_merge( $functions, $additional_functions );
    }

    public function update_twig_environment_options( $options ) {
        return $options;
    }

    /**
     * Load each component's functions.php dynamically.
     */
    public function load_components() {
        $components_dir = get_template_directory() . '/Components';

        if ( ! is_dir( $components_dir ) ) {
            return;
        }

        foreach ( scandir( $components_dir ) as $component ) {
            if ( in_array( $component, [ '.', '..' ], true ) ) {
                continue;
            }

            $path = $components_dir . '/' . $component . '/functions.php';
            if ( file_exists( $path ) ) {
                require_once $path;
            }
        }
    }

    /**
     * Enqueue JavaScript from each component and dark mode toggle.
     */
    public function enqueue_component_scripts() {
        $components_dir = get_template_directory() . '/Components';
        $components_uri = get_template_directory_uri() . '/Components';

        foreach ( glob( $components_dir . '/*/script.js' ) as $path ) {
            $component = basename( dirname( $path ) );

            wp_enqueue_script(
                "leanlogic-$component",
                "$components_uri/$component/script.js",
                [],
                filemtime( $path ),
                true
            );
        }

        // Enqueue global dark mode toggle
        wp_enqueue_script(
            'leanlogic-darkmode',
            get_template_directory_uri() . '/assets/scripts/dark-mode.js',
            [],
            filemtime( get_template_directory() . '/assets/scripts/dark-mode.js' ),
            true
        );
    }
}
