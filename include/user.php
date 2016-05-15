<?php
include_once('connect.php');

class user {
	
	private $id;
	private $name;
	private $mysqli;
	
	public function __construct() {
		$this->mysqli = dbConnect();
	}

	public function getId() {return $this->id;}
	public function getName() {return $this->name;}
	public function getMysqli() {return $this->mysqli;}
	
	public function setId($id) {$this->id = $id;}
	public function setName($name) {$this->name = $name;}
	
	
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