<?php

require_once 'dbconnect.php';

class City extends Database{
	public function __construct(){
		parent::__construct();
	}
	public function createCity($name, $zone, $greentax){
		$sql= "INSERT INTO city (city_name, city_zone, greentax, city_time, city_date)
			VALUES('".$name."', '".$zone."', '".$greentax."', '".date('H:i:s')."', '".date('y-m-d')."')";

		if ($this->conn->query($sql) === TRUE) {
			return 1;
		} else {
			return 0;
		}		
	}
	public function getCity($id){
		$sql= "SELECT * FROM city where city_id= '$id' ";
		$result = $this->conn->query($sql);	
		$arr= array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr['id']= $row['city_id'];
				$arr['name']= $row['city_name'];
				$arr['zone']= $row['city_zone'];
				$arr['greentax']= $row['greentax'];
			}
		}
		return $arr;
	}
	public function getCities(){
		$sql= "SELECT * FROM city";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i= 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[$i]['id']= $row['city_id'];
				$arr[$i]['name']= $row['city_name'];
				$arr[$i]['zone']= $row['city_zone'];
				$arr[$i]['greentax']= $row['greentax'];
				$i++;
			}
		}
		return $arr;
	}
	public function getName(){
		$sql= "SELECT * FROM city";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i= 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				//$arr[$i]['value']= $row['city_id'];
				$arr[$i]['label']= $row['city_name'];
				$arr[$i]['zone']= $row['city_zone'];
				$arr[$i]['value']= $row['greentax'];
				$i++;
			}
		}
		return $arr;
	}
	public function getCityByZone($zone){
		$sql= "SELECT * FROM city WHERE city_zone='$zone'";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i= 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[$i]['id']= $row['city_id'];
				$arr[$i]['name']= $row['city_name'];
				$arr[$i]['zone']= $row['city_zone'];
				$i++;
			}
		}
		return $arr;
	}
	public function updateCity($arr){
		$flag=0;
		$sql= "UPDATE city SET";
		$r=0;
		if(isset($arr['name'])){
			if($r>0){
				$sql= $sql." ,";
			}
			$sql= $sql." city_name= '".$arr['name']."'";
			$r++;
		}
		if(isset($arr['zone'])){
			if($r>0){
				$sql= $sql." ,";
			}
			$sql= $sql." city_zone= '".$arr['zone']."'";
			$r++;
		}
		if(isset($arr['greentax'])){
			if($r>0){
				$sql= $sql." ,";
			}
			$sql= $sql." greentax= '".$arr['greentax']."'";
			$r++;
		}
		
		$sql= $sql." WHERE city_id= '".$arr['id']."'";
		//echo $sql;
		if (mysqli_query($this->conn, $sql)) {
			$flag= 1;
		}
		return $flag;
		
	}
}	