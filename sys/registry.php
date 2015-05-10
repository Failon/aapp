<?php



/***
 *  Description of Registry
 *  Registry de les configuracions
 *  @author toni
 */
class Registry {
    private $data=array();
    
    static $instance;
    //public static $database=array();
    
    public static function getInstance(){
        if(!(self::$instance instanceof self)){
            self::$instance=new self();
            return self::$instance;
        }
        else{ return self::$instance;
            
        }
    }
    
    private function __construct() {
        $this->data=array();
    }
    
    function __set($key, $var) {
    $this->data[$key] = $var;
    return true;
  }

  function __get($key) {
    if (isset($this->data[$key]) == false) {
      return null;
    }
    return $this->data[$key];
  }

  function __unset($data) {
    unset($this->data[$key]);
  }
    public function getData(){
        return $this->data;
    }
    /***
     *  This function initializes and load
     *  config information  app, located in Config.json
     */
    function init(){
        $arr_json=json_decode(file_get_contents(APP.'Config.json'),true);
        foreach ($arr_json as $key=>$value) {
            $this->data[$key] = $value;
        }
        
    }
}