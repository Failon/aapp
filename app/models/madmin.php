<?php
/**
*	class mAdmin model for the Admin control panel.
*
*	@params: $params
	@return: init action
*	@author: Amador
*/
	final class mAdmin extends Model{
		
		function __construct($params){
			//get the user param from GET.
			parent::__construct($params);
			$this->db=DB::singleton();
			$this->data_out=$params;
		}

		public function init(){
			//init action, called on admin controller construc. connects to the database to retrieve the users information and
			//saved it on a table output string intended to be sent to vAdmin.
			//on failure displays the pdoexception message.
			$table="";
	        try {
	            $sql   = "SELECT  id_usuario, usuarios.nombre AS nombre, email, admin, activo, ciudades.nombre AS ciudad FROM usuarios INNER JOIN ciudades ON ciudad = id_ciudad";
	            $query = $this->db->prepare($sql);
	            $query->execute();
	            $table = "<table class='admin_users'><tr><th>id_user</th><th>name</th><th>email</th><th>admin</th><th>activo</th><th>ciudad</th><th>baja</th><th>alta</th>";
	            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
	                $table.="<tr><td>".$row['id_usuario']."</td><td>".$row['nombre']."</td><td>".$row['email']."</td><td>".$row['admin']."</td><td>".$row['activo']."</td><td>".$row['ciudad']."</td><td><a href='".APP_W."admin/cancel/user/".$row['id_usuario']."'>unsuscribe</a></td><td><a href='".APP_W."admin/alta/user/".$row['id_usuario']."'>resuscribe</a></td></tr>";
	            }
	            $table.="</table>";
	        }
	        catch (PDOException $e) {
	            echo "Error:" . $e->getMessage();
	        }
	        return $table;		
		}
		function cancel(){
			//cancel action, to unsuscribe application users, changed actio field on usuarios table from 1 to 0.
			//returns 0 upon succes.
			//return -1 upon a PDOException and displays its error message.
			//returns -2 if the admin tried to unsuscribe himself.
			$error = 0;
			$id_usuario = $this->params_in[1];
			if($id_usuario != $_SESSION['idusuario']){
				try{
					$sql = "UPDATE usuarios SET activo = 0 WHERE id_usuario = ?";
					$query = $this->db->prepare($sql);
					$query->bindParam(1, $id_usuario);
					$query->execute();
				}catch (PDOException $e) {
		            echo "Error:" . $e->getMessage();
		            $error = -1;
		        }				
			}else{
				$error = -2;
			}
	        return $error;
		}
		function alta(){
			//alta action, to unsuscribe application users, changed actio field on usuarios table from 0 to 1.
			//returns 0 upon succes.
			//return -1 upon a PDOException and displays its error message.
			//returns -2 if the admin tried to suscribe himself.
			$error = 0;
			$id_usuario = $this->params_in[1];
			if($id_usuario != $_SESSION['idusuario']){
				try{
					$sql = "UPDATE usuarios SET activo = 1 WHERE id_usuario = ?";
					$query = $this->db->prepare($sql);
					$query->bindParam(1, $id_usuario);
					$query->execute();
				}catch (PDOException $e) {
		            echo "Error:" . $e->getMessage();
		            $error = -1;
		        }				
			}else{
				$error = -2;
			}
	        return $error;
		}			
		}
	
