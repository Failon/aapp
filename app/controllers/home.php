<?php
/*
*	home controller, for the home page
*
*	@params: $params
	@return: mHome, vHome
*	@author: Amador
*/
	final class home extends Controller{
		
		function __construct($params){
			parent::__construct($params);
			$this->conf=Registry::getInstance();

			$this->model=new mHome($params);
			$this->view=new vHome;
		}
		function home(){
			//home action
		}
		function login(){
			//login action
			//attempts to launch the model login action, on success relaunches de controller, on Failure displays the error.
			$user = strtolower($_POST['email']);
			$password = strtolower($_POST['password']);
			$respuesta_modelo = $this->model->login($user, $password);
			if($respuesta_modelo){
				header('Location:'.APP_W.'home');
			}else{
				echo 'Incorrect Login';
			}
		}
		function logout(){
			//logout action.
			//destroys the session then relaunches home controller.
			session_destroy();
			header('Location:'.APP_W.'home');
		}

	}