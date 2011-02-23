<?php
/**
 *
 */

function is_method($method){
   return ($_SERVER['REQUEST_METHOD'] == $method);
}

function is_post(){
   return is_method('POST');
}

function is_get(){
   return is_method('GET');
}
