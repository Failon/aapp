<?php
/**
*	class mReg for the subscription page.
*
*	@params: none
	@return: register
*	@author: Amador
*/
	class mReg extends Model{

		function __construct(){
			parent::__construct();
		}
		
		function register($name, $password, $email, $city){
			//register action
			//attempts to register the user in the system with the information given by parameters.
			//Upon success returns 0.
			//Upon database error returns -1
			//If the city is not found on the ciudades table returns -2
			$error = 0;//inserted successfully
			$name = strtolower($name);
			$password = md5(strtolower($password));
			$email = strtolower($email);
			$city = strtolower($city);
			try {
				//determinar ciudad
				$sql = "SELECT id_ciudad FROM ciudades WHERE nombre = ?";
				$query = $this->db->prepare($sql);
				$query->bindParam(1, $city);
				$query->execute();
	            if ($query->rowCount() == 1) {
	                $city = $query->fetch(PDO::FETCH_ASSOC);	
	            }
	            else{
	            	$error = -2;//no such name city
	            }
				//insertar	            
	            if($error == 0){
	            $sql   = "INSERT INTO usuarios (nombre, email, password, ciudad, activo) VALUES(:name, :email, :password, :city, 1)";
	            $query = $this->db->prepare($sql);
	            $query->bindParam(':name', $name);
	            $query->bindParam(':email', $email);
	            $query->bindParam(':password', $password);
	            $query->bindParam(':city', $city['id_ciudad']);
	            $query->execute(); 
	            }	

	        }
	        catch (PDOException $e) {
	            echo "Error:" . $e->getMessage();
	            $error = -1;//pdoexception
	        }

	        return $error;
		}
	}