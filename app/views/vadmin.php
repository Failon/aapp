<?php
/*
*	class vAdmin view for the admin control panel.
*
*	@params: $contents, $data
	@return: admin template
*	@author: Amador
*/
	class vAdmin{
		protected $reg;
		
		function __construct($contents, $data){
			$this->reg=Registry::getInstance();
			$array_app=(array)$this->reg->app_data;
			$array_app['tabla'] = $data;
			Template::load($contents,$array_app);
				
		}
		
	}