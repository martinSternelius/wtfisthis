<?php
/*
 * This file is the parent to all the api calls and should be mod rewrited to allow pretty urls
 * It should answer to different GET parameters and include other files that carries out the workload
 * No functional code should be in here, in other words
 *
 *
 * Flickr user url:
 * http://www.flickr.com/photos/59481302@N07/
 *
 * Login to Flickr: 
 * username: wtfisthiscontact@yahoo.com
 * password: ASDFqwerty123
 */
require_once '../lib/base.php';


// First check if the call is for a resource (in the database)
// at this point we die if the request is for anything but a resource
if (!isset($_GET['resource'])) die('invalid request');

$method   = $_SERVER['REQUEST_METHOD'];
$resource = $_GET['resource'];  

//Ensure the resource parameter is only alpha chars
if(preg_match('/^[\w]+$/', $resource) < 1) die('invalid resource');


/*
 * Move handling of different resources to separate thing_handler.php
 * files to make it easier to add or edit separate resource handlers
 */

$handler = $resource . '_handler.php';
if(file_exists($handler)){
   include $handler;
} else {
   die('invalid resource');
}
