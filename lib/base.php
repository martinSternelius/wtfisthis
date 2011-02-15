<?php
/**
 * include local configurations*/

require_once 'config.php';

 

/**
 * Add lib/ to include-path so we get slightly cleaner includes
 */
//set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ );

/**
 * Set autoloader for classes
 */
function __autoload($class_name) {
       include 'classes/' . $class_name . '.class.php';
}

/**
 * Flickr settings
 */
define('FLICKR_API_KEY','18c61b543dcdfe6f939d181a8d52f333');
define('CFG_FLICKR_TOKEN', '72157626047361260-b1b8d44f9efe7d65');
