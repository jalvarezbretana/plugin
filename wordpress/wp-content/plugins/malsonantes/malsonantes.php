<?php
/*
Plugin Name: Malsonantes
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is just a filter plugin.
Author: Hadesito
Version: 1.7.2
Author URI: http://ma.tt/
*/
function caca( $text ) {
    return str_replace( 'caca', 'popo', $text );
}
function culo( $text ) {
    return str_replace( 'culo', 'pompis', $text );
}function muerte( $text ) {
    return str_replace( 'muerte', 'defunción', $text );
}function pedo( $text ) {
    return str_replace( 'pedo', 'flatulencia', $text );
}function subnormal( $text ) {
    return str_replace( 'subnormal', 'guapo', $text );
}
add_filter( 'the_content', 'caca');
add_filter( 'the_content', 'culo');
add_filter( 'the_content', 'muerte');
add_filter( 'the_content', 'pedo');
add_filter( 'the_content', 'subnormal');
