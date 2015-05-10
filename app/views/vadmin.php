<?php
	class vAdmin{
		protected $reg;
		
		function __construct($contents, $data){
			$this->reg=Registry::getInstance();
			//access to app_data
			$array_app=(array)$this->reg->app_data;
			$array_app['tabla'] = $data;
			Template::load($contents,$array_app);
				
		}
		
	}