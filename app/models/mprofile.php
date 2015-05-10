<?php
	class mProfile extends Model{

		function __construct(){
			parent::__construct();
		}

		function update($data){
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