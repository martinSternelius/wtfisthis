<?php
/**
 * This class should be used to validate form input
 */

class Validator {
   private $fields = array();
   private $result = array();
   private $indata;
   private $errs = array();
   private $required_file = null;

   public function __construct($indata){
      $this->indata = $indata;
   }

   public function is_valid(){
      if($this->required_file != null){
         if(isset($_FILES[$this->required_file])){
            $this->result['_file'] = $_FILES[$this->required_file]['tmp_name'];
         }else{
            $this->errs[] = 'required file missing';
            return false;
         }
      }
      foreach ($this->fields as $field => $rules)
         if(!$this->valid_field($field))
            return false;
      return true;
   }

   public function add_field($fieldname, $rules = array()){
      $this->fields[$fieldname] = $rules; 
   }

   public function require_file($fieldname){
      $this->required_file = $fieldname;
   }

   public function valid_field($field){
      // a field that's not defined is not valid
      if(!$this->is_defined($field)) return false;
      // a field that is defined but has no rules is always valid
      if(empty($this->fields[$field])) return true;
      // a field that is required but not passed is invalid
      if($this->is_required($field)&& !($this->in_indata($field))){
        $this->errs[] = 'required field '.$field.' missing';
        return false;
      }
      
      return true;
   }

   public function get_data(){
      $data = $this->result;
      foreach($this->fields as $field => $rules){
         if($this->in_indata($field)&&!empty($this->indata[$field])){
            $data[$field] = $this->indata[$field];
         }elseif($this->has_rule($field,'default')){
            $data[$field] = $this->fields[$field]['default'];
         } else {
            $data[$field] = null;
         }
      }
      return $data;
   }

   public function errors(){
      return array('error' => $this->errs);
   }
   /**
    * helper methods
    */
   public function is_defined($field){
      return isset($this->fields[$field]);
   }

   public function in_indata($field){
      return isset($this->indata[$field]);
   }

   public function rules($field){
      if(!$this->is_defined($field)) return array();
      return $this->fields[$field];
   }

   public function has_rule($field,$rule){
      return ($this->is_defined($field) &&
         isset($this->fields[$field][$rule]));
   }

   public function get_rule($field,$rule){
      if(!$this->has_rule($field,$rule)) return null;
      return $this->fields[$field][$rule];
   }

   public function is_required($field){
      $rule = $this->get_rule($field,'required');
     
      return ($rule == true);
   }
   
}
