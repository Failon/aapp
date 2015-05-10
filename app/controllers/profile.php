<?php

	final class profile extends controller{
		function __construct($params){
			parent::__construct($params);
			$this->conf=Registry::getInstance();
			$this->model=new mProfile($params);
			$this->view=new vProfile;
		}
		function home(){

		}
		function update(){
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

			if(md5($_POST['actual_password'])==$_SESSION['password']){
				if($_POST['password'] == $_POST['repassword']){
					$model = $this->model->password($_POST['password']);
					if($model==0){
						echo "password actualizada con exito";
					}else{
						echo "ha habido un error al actualizar la contraseña";
					}
				}
			}else{
				echo "Introduce la contraseña actual correctamente";
			}
		}
		function cancel(){
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