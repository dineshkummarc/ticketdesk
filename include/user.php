<?php
include_once('connect.php');

class user {
	
	private $id;
	private $name;
	private $email;
	private $mysqli;
	
	function __construct() {
		$this->mysqli = dbConnect();
	}
	
	public static function withUserName($userName) {
		$instance = new self();
		$instance->getUser($userName);
		return $instance;
		
	}
	public function getUser($userName) {
		$sql = "select * from users where username = '" . $userName . "'";
		$result = $this->mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$this->id = $row['id'];
				$this->name = $row['username'];
				$this->email = $row['email'];
			}
		}
	
	}
	public function getEmail() {return $this->email;}
	public function getId() {return $this->id;}
	public function getName() {return $this->name;}
	public function getMysqli() {return $this->mysqli;}
	
	public function setId($id) {$this->id = $id;}
	public function setName($name) {$this->name = $name;}
	public function setEmail($email) {$this->email = $email;}
	
	
	public static function displayUserOptionList() {
		$mysqli = dbConnect();
		$sql = "select * from users";
		$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo '<option value="' .  $row['username']  . '">' . $row['username'] . '</option>';
			}
		}
	}


}	



?>