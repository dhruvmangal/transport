<?php

class Database{
	public function __construct(){
		$this->conn=  $this->connectDB(); 
	}
	protected function connectDB(){
		$this->conn= mysqli_connect('localhost', 'root', '', 'logistics');
		return $this->conn;
	}
}

?>