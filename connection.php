<?php

class SqlConnection{

	public $hostname;
	public $username;
	public $password;
	public $dbname;
	public $conn = NULL;

	public function __construct($hostname = "localhost", $username = "root", $password = "", $dbname = "is218final")
	{
		$this->hostname = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->dbname = $dbname;
	}
	public function connect(){

		$dsn = 'mysql:host='.$this->hostname.';dbname='.$this->dbname;

		try 
		{
			$this->conn = new PDO($dsn, $this->username, $this->password);
			if(isset($this->conn)){echo "sucessfully connected".PHP_EOL;}
		}
		catch(PDOException $e)
		{
			// echo "Connection failed: " . $e->getMessage();
			$this->http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n" . $e->getMessage());
		}

	}

	// Runs SQL query and returns results (if valid)
	function runQuery($query) {
		try {
			$q = $this->conn->prepare($query);
			$success = $q->execute();
			$results = $q->fetchAll(PDO::FETCH_ASSOC);
			$q->closeCursor();
			
			return $results;	
		} catch (PDOException $e) {
			$results = $this->http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n" . $e->getMessage());
			return $results;
		}	  
	}
	function doLogin($username, $password) 
	{  
		$sql = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
		$results = $this->runQuery($sql);

		// if (!empty($results)){
		// 	foreach ($results as $row) {
		// 		echo "<pre>";
		// 		print_r( $row );
		// 		echo "</pre>";
		// 	}
		// 	echo "<pre>";
		// 	print_r  ($results);
		// 	echo "</pre>";	
		// }
		// else {echo "anan";}
		
		return $results;
	}
	function findUserName($username) 
	{  
		$sql = "SELECT * FROM `users` WHERE username='$username'";
		$results = $this->runQuery($sql);

		// if (!empty($results)){
		// 	foreach ($results as $row) {
		// 		echo "<pre>";
		// 		print_r( $row );
		// 		echo "</pre>";
		// 	}
		// 	echo "<pre>";
		// 	print_r  ($results);
		// 	echo "</pre>";	
		// }
		// else {echo "anan";}
		
		return $results;
	}
	
	function findEmail($email) 
	{  
		$sql = "SELECT * FROM `users` WHERE email='$email'";
		$results = $this->runQuery($sql);

		// if (!empty($results)){
		// 	foreach ($results as $row) {
		// 		echo "<pre>";
		// 		print_r( $row );
		// 		echo "</pre>";
		// 	}
		// 	echo "<pre>";
		// 	print_r  ($results);
		// 	echo "</pre>";	
		// }
		// else {echo "anan";}
		
		return $results;
	}

	function changeUsername($from, $to){
		$sql = "UPDATE `users` 
                    SET `username`='".$to."'
                    WHERE `username`='".$from."'";

		$results = $this->runQuery($sql);

		return $results;

	}

	function changePassword($username, $password){
		$sql = "UPDATE `users` 
				SET 
				`password`='".$password."'
				
				WHERE `username`='".$username."'";

		$results = $this->runQuery($sql);

		return $results;
	}

	function registerUser($user){
		$sql = "INSERT INTO `users`
				(`username`, `email`, `password`, `LastName`, `FirstName`) 
				VALUES ('$user->username', '$user->email','$user->password', '$user->lastName', '$user->firstName')";

		$results = $this->runQuery($sql);

		return $results;
	}
	function createTask($task){
		$sql = "INSERT into `tasks`
				(`username`, `title`, `description`, `due`, `urgency`, `completion`)
				VALUES ('$task->username', '$task->title', '$task->description', '$task->due', '$task->urgency', '$task->completion')";

		$results = $this->runQuery($sql);

		return $results;
	}
	function http_error($message) 
	{
		header("Content-type: text/plain");
		// die($message); // Don't die here so we can ACTUALLY do something with null sql results
		// echo $message."\n\n";
		return $message;
	}
}
?>
