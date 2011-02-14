<?php
// Superclass for the objects that shares some functionality

abstract class WTF {
  

	/* JSON PARSING */
	
	public function toArray() {
	     return $this->processArray(get_object_vars($this));
	 }

	 private function processArray($array) {
	     foreach($array as $key => $value) {
	         if (is_object($value)) {
	             $array[$key] = $value->toArray();
	         }
	         if (is_array($value)) {
	             $array[$key] = $this->processArray($value);
	         }
	     }
	     // If the property isn't an object or array, leave it untouched
			 
	     return $array;
	 }
	
	// a bug in PHP prior to September 2010 auto escapes "/", this is a fix for urls to be properly formatted
	// read more on http://se.php.net/manual/en/function.json-encode.php#100679
	public function toJson() {
		$json = json_encode($this->toArray());
		return str_replace('\\/', '/', $json);
	}
	
	/* END JSON PARSING */
	
	
	/* XML PARSING */
	
	function flickrImageSizeXML2Array($xml){
		$image_array = Array();
		$i = 0;
    foreach($xml->children() as $sizes){
			foreach($sizes->children() as $size) {
				$image_array[$i]['label'] = (string)$size[0]['label'];
				$image_array[$i]['url'] = stripcslashes((string)$size[0]['source']);
				$i++;
			}
		}
		return $image_array;
	}
  
}