<?php
	final class mHome extends Model{
		
		function __construct($params){
			parent::__construct($params);
			$this->db=DB::singleton();
			// a litle prove in--->out
			$this->data_out=$params;
		}
		function get_out(){
			return $this->data_out;
		}
		function login($user,$password){
			$password = md5($password);
			if(isset($user)){
				$retorno = TRUE;
		        try {
		            $sql   = "SELECT nombre, id_usuario, admin, activo FROM usuarios WHERE email=? AND password=?";
		            $query = $this->db->prepare($sql);
		            $query->bindParam(1, $user);
		            $query->bindParam(2, $password);
		            $query->execute(); 
		            if ($query->rowCount() == 1) {
		                $result = $query->fetch(PDO::FETCH_ASSOC);
			            if($result['activo']=='1'){
			                $_SESSION['usuario']  = $result['nombre'];
			                $_SESSION['idusuario'] = $result['id_usuario'];
			                $_SESSION['password'] = md5($_REQUEST['password']);
			                $_SESSION['admin'] = $result['admin'];
			            }else{
			            	$retorno = FALSE;
			            }
		            } else {
		                $retorno = FALSE;
		            }
		        }
		        catch (PDOException $e) {
		            echo "Error:" . $e->getMessage();
		        }				
			}else{
				echo "Error, introduce los parametros del login";
			}
			return $retorno;
		}
	}