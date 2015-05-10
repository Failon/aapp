<?php
	/***
	 *  class View
	 * 	access to registry and loads
	 *  the corresponding template
	 */
	class View{
		protected $reg;
		
		function __construct($contents){
			$this->reg=Registry::getInstance();
			//access to app_data
			$array_app=(array)$this->reg->app_data;
			Template::load($contents,$array_app);
				
		}
		
	}