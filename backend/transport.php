<?php
require_once 'dbconnect.php';

class Transport extends Database{
	public function __construct(){
		parent::__construct();
	}
	
	public function createTransport($name){
		$sql= "INSERT INTO transport(transport_company, transport_time, transport_date)
		VALUES('".$name."', '".date('H:i:s')."', '".date('y-m-d')."')";
		//echo $sql;
		if ($this->conn->query($sql) === TRUE) {
			return 1;
		} else {
			return 0;
		}	
	}
	public function viewTransport($id){
		$sql= "SELECT * FROM transport where transport_id= '$id' ";
		$result = $this->conn->query($sql);	
		$arr= array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr['id']= $row['transport_id'];
				$arr['name']= $row['transport_company'];
				
			}
		}
		return $arr;
	}
	public function viewTransports(){
		$sql= "SELECT * FROM transport";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i=0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[$i]['id']= $row['transport_id'];
				$arr[$i]['name']= $row['transport_company'];
				$i++;
			}
		}
		return $arr;
	}
	public function nameTransports(){
		$sql= "SELECT * FROM transport";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i=0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[$i]['value']= $row['transport_id'];
				$arr[$i]['label']= $row['transport_company'];
				$i++;
			}
		}
		return $arr;
	}
	public function updateTransport($arr){
		$flag=0;
		$sql= "UPDATE transport SET transport_company= '".$arr['name']."' WHERE transport_id= '".$arr['id']."'";
		if (mysqli_query($this->conn, $sql)) {
			$flag= 1;
		}
		return $flag;
	}
}

?>