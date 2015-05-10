<?php
	final class home extends Controller{
		
		function __construct($params){
			parent::__construct($params);
			$this->conf=Registry::getInstance();

			$this->model=new mHome($params);
			$this->view=new vHome;
		}
		function home(){
			
		}
		function login(){
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
			session_destroy();
			header('Location:'.APP_W.'home');
		}

	}