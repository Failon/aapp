<?php
/**
*	class reg controller to control the suscription page.
*
*	@params: none
	@return: mReg, vReg
*	@author: Amador
*/
	class Reg extends Controller{
		
		function __construct(){
			parent::__construct($this->params);
			$this->conf=Registry::getInstance();
			$this->model=new mReg;
			$this->view=new vReg;
		}
		function home(){
			//home action
		}

		function send(){
			//send action
			//verify if all required inputs were filled on the form and controlls if password and repassword match.
			//if verified, call upon the model register action and passes the data retrieved by POST to it.
			//on success display the success message, on failure displays the error message.
			if(isset($_POST['name'], $_POST['password'], $_POST['repassword'], $_POST['email'], $_POST['city'])){
				if($_POST['password'] === $_POST['repassword']){
					$insert_user = $this->model->register($_POST['name'], $_POST['password'], $_POST['email'], $_POST['city']);
					if($insert_user==0){
						echo "registro realizado con exito";
					}
					else if($insert_user==-2){
						echo "introduce una ciudad válida";
					}
					else if($insert_user==-1){
						echo "Error de conexión con la base de datos";
					}
				}else{
					echo "passwords do not match";
				}	
			}else{
				echo "Enter all the required fields";
			}
			
		}
	}