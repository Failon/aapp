<?php
/**
*	class mProfile model for the user profile section
*
*	@params: none
	@return: update, password, cancel
*	@author: Amador
*/
	class mProfile extends Model{

		function __construct(){
			parent::__construct();
		}

		function update($data){
			//update action
			//if set, determines the id of the city name passed by reference.
			//updates the user in the usuarios table with all the info given
			//upon sucess returns 0. upon failure returns -1 and displays the error message
			$error = 0;
			$long = sizeof($data);
			try {
	            if(array_key_exists('city', $data)){	            					
					$sql = "SELECT id_ciudad FROM ciudades WHERE nombre = ?";
					$query = $this->db->prepare($sql);
					$query->bindParam(1, $data['city']);
					$query->execute();
		            if ($query->rowCount() == 1) {
		                $city = $query->fetch(PDO::FETCH_ASSOC);	
		            }
		            else{
		            	$error = -2;//no such name city
		            }
	            }					            
	            if($error == 0){
	            	$contador = 1;
		            $sql   = "UPDATE usuarios SET";

		            if(array_key_exists('name', $data)){
		            	$sql.=" nombre = '".$data['name']."'";
		            	if($contador >= 1 && $contador < $long ){
		            		$sql.=",";
		            		$contador++;
		            	}
		            }
		            if(array_key_exists('email', $data)){
		            	$sql.=" email = '".$data['email']."'";
		            	if($contador >= 1 && $contador < $long ){
		            		$sql.=",";
		            		$contador++;
		            	}
		            }
		            if(array_key_exists('city', $data)){
		            	$sql.=" ciudad = '".$data['city']."'";
		            	if($contador >= 1 && $contador < $long ){
		            		$sql.=",";
		            		$contador++;
		            	}		            	
		            }
		            $sql.=" WHERE id_usuario = ".$_SESSION['idusuario'];                 
		            $query = $this->db->prepare($sql);
		            $query->execute();
		            if(array_key_exists('name', $data)){
		            	$_SESSION['usuario'] = $data['name'];
		            }
	        	}
	        }catch (PDOException $e) {
	        	$error = -1;
	            echo "Error:" . $e->getMessage();
	            //pdoexception
	        }
	        return $error;
		}
		function password($password){
			//password action
			//encrypts the password to md5 and updates the password information for the user id in the SESSION variable.
			//returns 0 upon success or -1 upon failure with the PDOException error message.
			$error = 0;
			$password = md5($password);
			try{
				$sql = "UPDATE usuarios SET password ='".$password."' WHERE id_usuario = ".$_SESSION['idusuario'];
				$query = $this->db->prepare($sql);
				$query->execute();
			}catch(PDOException $e){
				$error = -1;
				echo "Error:" . $e->getMessage();
			}
			return $error;
		}

		function cancel(){
			//cancel action
			//unsuscribe the user on the usuarios table updating the activo field to 0.
			//upon success returns 0. Upon Failure returns -1 with the PDOException error message
			$error = 0;
			try{
				$sql = "UPDATE usuarios SET activo = 0 WHERE id_usuario = ".$_SESSION['idusuario'];
				$query = $this->db->prepare($sql);
				$query->execute();
			}catch(PDOException $e){
				$error = -1;
				echo "Error:" . $e->getMessage();
			}
			return $error;
		}
	}