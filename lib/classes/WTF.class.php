<?php
// Superclass for the objects that shares some functionality

abstract class WTF {
  
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
   
    public function toJson() {
        return json_encode($this->toArray());
    }
  
}