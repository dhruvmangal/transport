<?php

require_once 'dbconnect.php';

class User extends Database{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function createUser($arr){
		$sql="insert into user (user_name, user_email, user_phone, user_password, user_time, user_date)
		VALUES('".$arr['name']."','".$arr['email']."','".$arr['phone']."','".$arr['password']."','".date('y-m-d')."','".date('H:i:s')."')";
		if ($this->conn->query($sql) === TRUE) {
			$id= $this->conn->insert_id;
			return $id;
		} else {
			return 0;
		}
		
	}
	public function getuser($id){
		$sql= "SELECT * FROM user where user_id= '$id' ";
		$result = $this->conn->query($sql);	
		$arr= array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr['id']= $row['user_id'];
				$arr['name']= $row['user_name'];
				$arr['phone']= $row['user_phone'];
				$arr['email']= $row['user_email'];
			}
		}
		return $arr;
	}
	public function getUsers(){
		$sql= "SELECT * FROM user";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i= 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[$i]['id']= $row['user_id'];
				$arr[$i]['name']= $row['user_name'];
				$arr[$i]['phone']= $row['user_phone'];
				$arr[$i]['email']= $row['user_email'];
				$i++;
			}
			
		}
		return $arr;
	}
	public function deleteUser($id){
		$sql= "delete from user where user_id= '$id'";
		$flag=0;
		if (mysqli_query($this->conn, $sql)) {
			$flag= 1;
		}
		return $flag;	
	}
	
	public function updateUser($id, $name, $phone, $email){
		$sql= "update user set user_name= '$name', user_phone= '$phone', user_email= '$email' where user_id= '$id'";
		$flag=0;
		if (mysqli_query($this->conn, $sql)) {
			$flag= 1;
		}
		return $flag;	
	}
	public function updatePassword($id, $pwd, $npwd){
		$sql= "update user set user_password= '$npwd' where user_id= '$id' and user_password='$pwd'";
		$flag=0;
		if (mysqli_query($this->conn, $sql)) {
			$flag= 1;
		}
		return $flag;	
	}
	public function loginUser($phone, $password){
		$sql="Select user_id from user where user_phone= '$phone' and user_password= '$password'";
		$result = $this->conn->query($sql);	
		$arr= array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr['id']= $row['user_id'];
			}
			
		}
		return $arr;
	}
	public function logout(){
		
	}
}
?>