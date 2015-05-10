<?php
	function base($str){
            if($str=='//'){
                return '/';
            }
            else return $str;
            
         }
	define('DS',DIRECTORY_SEPARATOR);
	define('ROOT',realpath(dirname(__FILE__)).DS);
	//to access filesystem
	define('APP',ROOT.'app'.DS);
	$app_w=dirname($_SERVER['PHP_SELF']).DS;
    define ('APP_W',base($app_w));
	//echo APP_W;
	// it could be in another file
	