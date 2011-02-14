<?php
/**
 * include local configurations*/
 if ( file_exists('config.php')){
	require_once 'config.php';
 }
 

/**
 * Add lib/ to include-path so we get slightly cleaner includes
 */
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ );

/**
 * Set autoloader for classes
 */
function __autoload($class_name) {
       include 'lib/classes/' . $class_name . '.class.php';
}

