<?php 

class Json {

   public static function emit_as_jsonp($data){

      $callback = '';
      if(isset($_GET['callback'])) {
         $callback = $_GET['callback'];
         $callback = preg_replace('|[^_$a-zA-Z0-9]*|','',$callback);
         $callback = ltrim($callback,'0123456789');
      }

      $json = str_replace('\\/', '/', json_encode($data));
      
      header('content-type: text/javascript; charset=utf-8');

      if(!empty($callback)){
         echo "{$callback}($json);";
      } else {
         echo $json;
      }
   }
}   

