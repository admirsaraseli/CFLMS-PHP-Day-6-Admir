<?php	
#this will avoid mysql_connect() deprecation error.
error_reporting( ~E_DEPRECATED & ~E_NOTICE );
define ('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define ('DBNAME', 'car_rental_agency');
$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
if  ( !$conn ) {
 die("Connection failed : " . mysqli_error());
}

?>


<?php
/*
class Database {

	public $db_host = "localhost";
	public $db_name = "car_rental_agency";
	public $db_user = "root";
	public $db_pw = "";
	public $connect = "";

	public function connect() {
		$this->connect = @mysqli_connect($this->db_host, $this->db_user, $this->db_pw, $this->db_name);
		return $this->connect;
	}

	public function read($table, $fields='*',$join='',$where='',$orderby=''){
	    $this->connect();
	    $fields = is_array($fields) ? implode (",", $fields) : $fields;
	    $join = is_array($join) ? implode (" ", $join) : $join;
	    $sql = "SELECT ".$fields." FROM ".$table." ".$join." ".$where." ".$orderby." ;";
	    $result = $this->connect->query($sql);

		if ($result->num_rows == 0){
		    $row = "No result";
		} else if (($result->num_rows == 1)){
		    $row = $result->fetch_assoc();
		} else{
		    $row = $result->fetch_all(MYSQLI_ASSOC);
		}

	    mysqli_close($this->connect);
	    return $row;
	}

	public function getUser($id) {
		$this->connect();
		$sql = "SELECT * FROM users where userId=".$id;
		$result = $this->connect->query($sql);
		$userRow = $result->fetch_assoc();
		mysqli_close($this->connect);
	    return $userRow;
	}

	public function getCars() {
		$this->connect();
		$sql = "SELECT * FROM classic_cars";
		$result = $this->connect->query($sql);
		//$row = $result->fetch_assoc();
		mysqli_close($this->connect);
		return $result;
	}
}

$conn = new Database();
$conn = $conn->connect();

}*/
?>