<?php
/*
*	class admin controller, controls the admin control panel actions for the admin role users.
*
*	@params: user/id
	@return: mAdmin, vAdmin
*	@author: Amador
*/
	final class admin extends Controller{
		
		function __construct($params){
			
			parent::__construct($params);
			$this->conf=Registry::getInstance(); //saves the conf registry

			$this->model=new mAdmin($params); //launch admin model;
			$datos = $this->model->init();	//launch init function of admin model;
			$this->view=new vAdmin('admin', $datos); //launches admin view with the model info.
		}

		function home(){
			//home action
		}

		function cancel(){
			//cancel action
			//calls model cancel action, on success relaunches the controller. on Failure displays the error.
			if($this->params[0]=='user'){
				$iduser = $this->params[1];
				if(isset($iduser)){
					$model = $this->model->cancel();
					if($model==0){
						header('Location:'.APP_W.'admin');
					}
					else if($model == -2){
						echo "Admins cannot unsuscribe";
					}else{
						echo "Database error";
					}					
				}				
			}	
		}
		function alta(){
			//alta action
			//calls model alta action, on succes relaunches the controller. On Failure displays the error.
			if($this->params[0]=='user'){
				$iduser = $this->params[1];
				if(isset($iduser)){
					$model = $this->model->alta();
					if($model==0){
						header('Location:'.APP_W.'admin');
					}else {
						echo "Error";
					}
				}				
			}			
		}
	}