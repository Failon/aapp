<?php
/**
*	profile controller for the profile control pannel for the application users.
*
*	@params: $params
	@return: mProfile vProfile
*	@author: Amador
*/
	final class profile extends controller{
		function __construct($params){
			parent::__construct($params);
			$this->conf=Registry::getInstance();
			$this->model=new mProfile($params);
			$this->view=new vProfile;
		}
		function home(){
			//home action
		}
		function update(){
			//update action
			//calls upon the the model update action and passes the form data retrieved by POST to it.
			//On success launches home controller, on failure displays the error message.
			$data = array();
			if(isset($_POST['name'])&&$_POST['name']!="") $data['name'] = strtolower($_POST['name']);
			if(isset($_POST['email'])&&$_POST['email']!="") $data['email'] = strtolower($_POST['email']);
			if((isset($_POST['city']))&&$_POST['city']!="") $data['city'] = strtolower($_POST['city']);
			if(!empty($data)){
				$model = $this->model->update($data);
				if($model==0){
					header('Location:'.APP_W.'home');
				}
				else if($model == -2){
					echo "ciudad incorrecta";
				}
				else if($model == -1){
					echo "error base de datos";
				}
			}			
		}
		function password(){
			//password action
			//calls upon the model password action and passes the form data retrived by POST to it.
			//On success launches home controller, on failure displays the error message.
			if(md5($_POST['actual_password'])==$_SESSION['password']){
				if($_POST['password'] == $_POST['repassword']){
					$model = $this->model->password($_POST['password']);
					if($model==0){
						header('Location:'.APP_W.'home');
					}else{
						echo "ha habido un error al actualizar la contraseña";
					}
				}
			}else{
				echo "Introduce la contraseña actual correctamente";
			}
		}
		function cancel(){
			//for non admin users
			//calls upon the model password action and passes the form data retrived by POST to it.
			//On success launches home/logout action, on failure displays the error message.			
			if($_SESSION['admin']!= '1'){
				$model = $this->model->cancel();
				if($model==0){
					header('Location:'.APP_W.'home/logout');
				}
				else{
					echo "no se ha podido eliminar de la base de datos, intentelo de nuevo";
				}
			}		
		}	
	}
?>