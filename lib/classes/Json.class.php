<?php 

class Json {

   public static function emit_as_jsonp($data, $iframeHack = false){
      /*
       * If we're passed callback as GET parameter
       * sanitize it and use it for JSONP output
       */
      $callback = '';
      if(isset($_GET['callback'])) {
         $callback = $_GET['callback'];
         $callback = preg_replace('|[^_$a-zA-Z0-9]*|','',$callback);
         $callback = ltrim($callback,'0123456789');
      }

      /*
       * Compensate for silly JSON encoding bug
       */
      $json = str_replace('\\/', '/', json_encode($data));
      
      /**
       * jQuery form file upload needs the return value of a 
       * filesubmit to be wrapped in <textarea> tags
       */
      $xhr = isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&
         $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
      
      if($iframeHack && $xhr) $iframeHack = false;

      if(!$iframeHack){
         header('content-type: text/javascript; charset=utf-8');
      }else{
         echo '<textarea>';
      }
     
      if(!empty($callback)){
         echo "{$callback}($json);";
      } else {
         echo $json;
      }

      if($iframeHack)
         echo '</textarea>';
   }
}   

