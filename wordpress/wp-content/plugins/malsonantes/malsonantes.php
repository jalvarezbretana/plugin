<?php
/*
Plugin Name: Malsonantes
Description: This is just a filter plugin.
Author: Hadesito
Version: 1.1
*/
function dB()
{

    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $malsonantes = $wpdb->prefix . 'malsonantes';

    $tableCreate = "CREATE TABLE IF NOT EXISTS $malsonantes (
    id mediumint(9) NOT NULL,
    correctWord text NOT NULL,
    PRIMARY KEY (id)
    ) $charset_collate;";

    $sqlDlt = "DELETE FROM $malsonantes";
    $wpdb->query($sqlDlt);
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sqlDlt);

    $sqlIns = "INSERT INTO $malsonantes (id, correctWord)
    VALUES (1, 'popo'),
           (2,'trasero'),
           (3,'feucho'),
           (4,'nepe'),
           (5,'flatulencia');";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($tableCreate);
    dbDelta($sqlIns);

}

add_action('plugins_loaded', 'dB');

function substitute_words($text)
{

    $rudeWords = array("caca", "culo", "feo", "polla", "pedo");

    global $wpdb;

    $malsonantes = $wpdb->prefix . 'malsonantes';

    $result = $wpdb->get_results("SELECT correctWord FROM " . $malsonantes, ARRAY_A);

    foreach ($result as $row) {
        $correctWords[] = $row['correctWord'];
    }

    return str_replace($rudeWords, $correctWords, $text);
}


add_action('plugins_loaded', 'substitute_words');
add_filter('the_content', 'substitute_words');

/**
 * Añade un tabla a la BD
 * @return void
 */
function myplugin_update_db_check()
{
    // Objeto global del WordPress para trabajar con la BD
    global $wpdb;

    // recojemos el
    $charset_collate = $wpdb->get_charset_collate();

    // le añado el prefijo a la tabla
    $table_name = $wpdb->prefix . 'dam';

    // creamos la sentencia sql
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        url varchar(55) DEFAULT '' NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // libreria que necesito para usar la funcion dbDelta
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

/**
 * Ejecuta 'myplugin_update_db_check', cuando el plugin se carga
 */
add_action('plugins_loaded', 'myplugin_update_db_check');