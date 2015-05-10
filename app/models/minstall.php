<?php
/*
*	class mInstal model to install the database of the application based on the app.sql syntax.
*
*	@params: $params
	@return: create
*	@author: Toni
*/
	class mInstall extends Model{
		protected $conf;

		function __construct($params){
			parent::__construct($params);
			$this->conf=Registry::getInstance();
			$this->db=DB::singleton();
			// a litle prove in--->out
			//$this->data_out=$params;
		}
		function get_out(){
			return $this->data_out;
		}
		function create($dbname){
			//creates the database with the conf dbname and executes the querys on app.sql.
			$dbhost = $this->conf->dbhost;
			$dbuser = $this->conf->dbuser;
			$dbpass = $this->conf->dbpass;
			$file=ROOT.'install/app.sql';
			//$this->import($dbhost,$dbuser,$dbpass,$dbname,$sql);
			try{
				$conn = new PDO($this->conf->driver.':host=' . $dbhost ,$dbuser, $dbpass);
				//$stmt = $conn->query("SHOW DATABASES");
    			//var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
    			$sql = 'CREATE Database '.$dbname.' CHARACTER SET utf8 COLLATE utf8_general_ci';
    			$stmt = $conn->query($sql);
    			
    			
    		}
				catch(PDOException $e)
			{
			  die('Could not connect: ' . $e->getMessage());
			}
			//disconnect PDO connection
			$conn=null;
			//now connecting with new DSN
			$dsn=$this->conf->driver.':host=' . $dbhost.';dbname='.$dbname;
			// Coder::code($dsn);
			try{
				$conn=new PDO($dsn,$dbuser,$dbpass);
			}catch(PDOException $e){
				die('Problem with connection'.$e->getMessage());
			}
			echo 'Processing SQL script';
			$query = file_get_contents($file);
			$sqlList=SQLParser::parse($query);

			
			// Coder::code_var($sqlList);
    		try {
    			foreach ($sqlList as $sqlline)
				{
					// Perform the query
    				$conn->query($sqlline);

					}
				}
			catch (PDOException $e)
			{
    			echo $e->getMessage();
    			die();
			}
			
			echo 'Final';
			return true;
		}
		function import($mysqlHostName,$mysqlUserName,$mysqlPassword,$mysqlDatabaseName,$mysqlImportFilename){
			//Export the database and output the status to the page
			$command='mysql -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
			exec($command,$output=array(),$worked);
			switch($worked){
    			case 0:
			        echo 'Import file <b>' .$mysqlImportFilename .'</b> successfully imported to database <b>' .$mysqlDatabaseName .'</b>';
			        break;
			    case 1:
			        echo 'There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' .$mysqlImportFilename .'</b></td></tr></table>';
			        break;
			}
		}

	}