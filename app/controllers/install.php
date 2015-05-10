<?php
/*
*	Install controller
*
*	@params: $params
	@return: mInstall, vInstall
*	@author: Toni
*/
	final class Install extends Controller{
		
		function __construct($params){
			parent::__construct($params);
			$this->conf=Registry::getInstance();

			$this->model=new mInstall($params);
			$this->view=new vInstall;
		}
		function home(){
			//home action
		}
		function create(){
			//create action attempts to create the project database from the app.sql file data.
			$dbname=$_POST['dbname'];
			if ($this->model->create($dbname)){
				//create file .deployed
				$fp = fopen(ROOT.'.deployed', 'w');
				// and redirects to home
				echo '<meta http-equiv="refresh" content="0; URL='.APP_W.'home/">';
				//header('location: '.APP_W.'home');
			};
			
		}
	}