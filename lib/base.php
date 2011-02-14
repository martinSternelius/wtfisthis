<?php 
require_once 'config.php';

function __autoload($class_name) {
       include 'lib/classes/' . $class_name . '.class.php';
}

