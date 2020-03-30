<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Custom sanitize function
 *
 * @return array 
 */
function ecl_allowed_tags()
{
    return array_merge(
        wp_kses_allowed_html( 'post' ),
        array(
            'iframe' => array(
                'allowfullscreen' => array(),
                'frameborder' => array(),
                'height' => array(),
                'src' => array(),
                'width' => array(),
            ),
            'noscript' => array(),
            "script" => array(
                'async' => array(),
                'charset' => array(),
                'src' => array(),
                'type' => array()
            ),
            'style' => array(
                'type' => array()
            )
        )
    );
}

/**
 * Custom function to sanitize JS
 */
function ecl_sanitize_js($input)
{
    return wp_kses($input, ecl_allowed_tags());
}

/**
 * Custom function to escaping JS
 */
function ecl_escape_js($input)
{
    return stripslashes_deep( html_entity_decode( trim( ecl_sanitize_js($input) ) ) ); 
}

function ecl_to_int($input)
{
    if(is_string($input))
    {
        $input = intval($input);
    }

    return $input > 0 ? 1 : 0; 
}

function ecl_css($input)
{
    return preg_replace( "/\r|\n/", "", $input );
}