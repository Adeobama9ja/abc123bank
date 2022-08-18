<?php
class Database
{
     
    private $host = "us-cdbr-east-06.cleardb.net";
    private $db_name = "heroku_853c12b08f48e55";
    private $username = "ba241a45845eca";
    private $password = "84058e0a";
    public $conn;
     
    public function dbConnection()
	{
     
	    $this->conn = null;
	    $DB_con = null;
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
			
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}

$connection = mysqli_connect('us-cdbr-east-06.cleardb.net', 'ba241a45845eca', '84058e0a');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'heroku_853c12b08f48e55');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}



$DB_host = "us-cdbr-east-06.cleardb.net";
$DB_user = "ba241a45845eca";
$DB_pass = "84058e0a";
$DB_name = "heroku_853c12b08f48e55";


try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
