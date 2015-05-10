<?php
	final class admin extends Controller{
		
		function __construct($params){
			parent::__construct($params);
			$this->conf=Registry::getInstance();

			$this->model=new mAdmin($params);
			$datos = $this->model->init();
			$this->view=new vAdmin('admin', $datos);
		}

		function home(){

		}

		function cancel(){
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