<?php 

/**
 * Singleton to handle all db communication
 *
 * Usage example:
 * <code>
 * require_once 'Db.php';
 *
 * $res = Db::query('SELECT * from `users`');
 *
 * while ($row = $res->fetch_assoc()){
 *   print_r($row);
 * }
 * </code>
 */

if(!defined('DBHOST')) die('DBHOST not defined');
if(!defined('DBUSER')) die('DBUSER not defined');
if(!defined('DBPASS')) die('DBPASS not defined');
if(!defined('DB')) die('DB not defined');

class Db {

   private static $connection = null;
   
   /**
    * Perform a query on the configured database
    * if there's already a connection then use it
    * if not then create one
    * 
    * @param string $query
    * 
    * @return mixed result of query 
    */
   public static function query($query){
       if(!self::$connection){
        self::initDb();
       }

       return self::$connection->query($query);
   }

   private static function initDb(){
      self::$connection = new mysqli(DBHOST,DBUSER,DBPASS,DB);
   }

   public static function error_msg(){
      if(!self::$connection){
         return "No connection";
      } else {
         return self::$connection->error;
      }
   }

   public static function escape($string){
      if(!self::$connection){
        self::initDb();
      }

      return self::$connection->real_escape_string($string);
   }

   /**
    * Return the id of the last insert
    * 
    * @return integer id of most recently inserted row in Db
    */
   public static function insert_id(){
     return self::$connection->insert_id;
   }

   /**
    * Get the current datetime from the Database
    *
    * @return string SQL value for NOW()
    */
   public static function get_now(){
      $result = Db::query('SELECT NOW() as now');
   	$row = $result->fetch_assoc();
      return $row['now'];
   }

   /**
    * Return the data from a request as an associative array;
    *
    * @param string $sql SQL query
    * @return mixed either an assoc array or false
    */
   public static function get_assoc($sql){
      $res = Db::query($sql);
      if(!$res){
         return false;
      }
      $result = array();
      while ($row = $res->fetch_assoc()){
         $result[] = $row;
      }
      return $result;
   }
   /**
   * Count rows in a table with optional filter
   *
   * @param  string $table table identifier
   * @param  string $filter optional WHERE clause to filter by
   * @return int rowcount 
   */
   public static function count($table,$filter = null){
      if($filter){ $filter = ' WHERE '.$filter; }
      $res = Db::query("SELECT COUNT(*) as rows FROM {$table}".$filter);
      if(!$res){return 0;}
      $row = $res->fetch_assoc();
      return $row['rows'];
   }
   
   /**
    * Get a prepared statement for the given sql
    *
    * @param string $sql
    * @return statement
    */
   public static function prepare($sql){
      if(!self::$connection){
        self::initDb();
      }

      return self::$connection->prepare($sql);
   }

}
