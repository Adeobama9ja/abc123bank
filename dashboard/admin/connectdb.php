<?php
class Database
{
     
    private $host = "localhost";
    private $db_name = "loghgacg_one";
    private $username = "loghgacg_one";
    private $password = "1lorentBank!";
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

$connection = mysqli_connect('localhost', 'loghgacg_one', '1lorentBank!');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'loghgacg_one');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}



$DB_host = "localhost";
$DB_user = "loghgacg_one";
$DB_pass = "1lorentBank!";
$DB_name = "loghgacg_one";


try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}