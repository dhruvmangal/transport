<?php

require_once 'dbconnect.php';

class Consigner extends Database{
	public function __construct(){
		parent::__construct();
	}
	public function createConsigner($arr){
		$sql= "INSERT INTO consigner (consigner_name, consigner_addr1, consigner_addr2, consigner_cft, consigner_fsc, consigner_fsc_min, consigner_rov, consigner_rov_min, consigner_oda, consigner_oda_min, consigner_time, consigner_date)
			values('".$arr['name']."','".$arr['addr1']."','".$arr['addr2']."','".$arr['cft']."','".$arr['fsc']."', '".$arr['fscmin']."', '".$arr['rov']."', '".$arr['rovmin']."', '".$arr['oda']."', '".$arr['odamin']."', '".date('H:i:s')."','".date('y-m-d')."')";
		//echo $sql;
		if ($this->conn->query($sql) === TRUE) {
			$id= $this->conn->insert_id;
			$this->createRates($id, $arr['aRate'], $arr['bRate'], $arr['cRate'], $arr['dRate'], $arr['eRate'], $arr['fRate'], $arr['gRate'], $arr['hRate'], $arr['iRate'], $arr['jRate']);
			return $id;
		} else {
			return 0;
		}	
	}
	public function getConsigner($id){
		$sql= "SELECT * FROM consigner LEFT JOIN rates ON consigner.consigner_id= rates.consigner_id WHERE consigner.consigner_id= '$id' ";
		$result = $this->conn->query($sql);	
		$arr= array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr['id']= $row['consigner_id'];
				$arr['name']= $row['consigner_name'];
				$arr['addr1']= $row['consigner_addr1'];
				$arr['addr2']= $row['consigner_addr2'];
				$arr['cft']= $row['consigner_cft'];
				$arr['fsc']= $row['consigner_fsc'];
				$arr['fscmin']= $row['consigner_fsc_min'];
				
				$arr['rov']= $row['consigner_rov'];
				$arr['rovmin']= $row['consigner_rov_min'];
				
				$arr['oda']= $row['consigner_oda'];
				$arr['odamin']= $row['consigner_oda_min'];
				
				$arr['aRate']= $row['a_rate'];
				$arr['bRate']= $row['b_rate'];
				$arr['cRate']= $row['c_rate'];
				$arr['dRate']= $row['d_rate'];
				$arr['eRate']= $row['e_rate'];
				$arr['fRate']= $row['f_rate'];
				$arr['gRate']= $row['g_rate'];
				$arr['hRate']= $row['h_rate'];
				$arr['iRate']= $row['i_rate'];
				$arr['jRate']= $row['j_rate'];
				
			}
		}
		return $arr;
	}	
	public function getConsigners(){
		$sql= "SELECT * FROM consigner LEFT JOIN rates ON consigner.consigner_id= rates.consigner_id";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i=0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[$i]['id']= $row['consigner_id'];
				$arr[$i]['name']= $row['consigner_name'];
				$arr[$i]['addr1']= $row['consigner_addr1'];
				$arr[$i]['addr2']= $row['consigner_addr2'];
				$arr[$i]['cft']= $row['consigner_cft'];
				$arr[$i]['fsc']= $row['consigner_fsc'];
				$arr[$i]['rov']= $row['consigner_rov'];
				$arr[$i]['oda']= $row['consigner_oda'];
				$arr[$i]['aRate']= $row['a_rate'];
				$arr[$i]['bRate']= $row['b_rate'];
				$arr[$i]['cRate']= $row['c_rate'];
				$arr[$i]['dRate']= $row['d_rate'];
				$arr[$i]['eRate']= $row['e_rate'];
				$arr[$i]['fRate']= $row['f_rate'];
				$arr[$i]['gRate']= $row['g_rate'];
				$arr[$i]['hRate']= $row['h_rate'];
				$arr[$i]['iRate']= $row['i_rate'];
				$arr[$i]['jRate']= $row['j_rate'];
				$i++;
			}
		}
		return $arr;
	}
	public function getNames(){
		$sql= "SELECT * FROM consigner";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i=0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[$i]['value']= $row['consigner_id'];
				$arr[$i]['label']= $row['consigner_name'];
				$i++;
			}
		}
		return $arr;
	}
	
	public function updateConsigner($arr){
		$flag=0;
		$sql= "UPDATE consigner SET";
		$r=0;
		if(isset($arr['name'])){
			if($r>0){
				$sql= $sql.' ,';
			}
			$sql = $sql." consigner_name= '".$arr['name']."'";
			$r++;
		}
		if(isset($arr['addr1'])){
			if($r>0){
				$sql= $sql.' ,';
			}
			$sql = $sql." consigner_addr1= '".$arr['addr1']."'";
			$r++;
		}
		if(isset($arr['addr2'])){
			if($r>0){
				$sql= $sql.' ,';
			}
			$sql = $sql." consigner_addr2= '".$arr['addr2']."'";
			$r++;
		}
		if(isset($arr['cft'])){
			if($r>0){
				$sql= $sql.' ,';
			}
			$sql = $sql." consigner_cft= '".$arr['cft']."'";
			$r++;
		}
		if(isset($arr['fsc'])){
			if($r>0){
				$sql= $sql.' ,';
			}
			$sql = $sql." consigner_fsc= '".$arr['fsc']."'";
			$r++;
		}
		if(isset($arr['fscmin'])){
			if($r>0){
				$sql= $sql.' ,';
			}
			$sql = $sql." consigner_fsc_min= '".$arr['fscmin']."'";
			$r++;
		}
		if(isset($arr['rov'])){
			if($r>0){
				$sql= $sql.' ,';
			}
			$sql = $sql." consigner_rov= '".$arr['rov']."'";
			$r++;
		}
		if(isset($arr['rovmin'])){
			if($r>0){
				$sql= $sql.' ,';
			}
			$sql = $sql." consigner_rov_min= '".$arr['rovmin']."'";
			$r++;
		}
		if(isset($arr['oda'])){
			if($r>0){
				$sql= $sql.' ,';
			}
			$sql = $sql." consigner_oda= '".$arr['oda']."'";
			$r++;
		}
		if(isset($arr['odamin'])){
			if($r>0){
				$sql= $sql.' ,';
			}
			$sql = $sql." consigner_oda_min= '".$arr['odamin']."'";
			$r++;
		}
		$sql= $sql." WHERE consigner_id= '".$arr['id']."'";
		
		if (mysqli_query($this->conn, $sql)) {
			$flag= 1;
		}
		return $flag;
	}
	public function createRates($id, $aRate, $bRate, $cRate, $dRate, $eRate, $fRate, $gRate, $hRate, $iRate, $jRate){
		$sql= "INSERT INTO rates (consigner_id, a_rate, b_rate, c_rate, d_rate, e_rate, f_rate, g_rate, h_rate, i_rate, j_rate)
			VALUES('".$id."', '".$aRate."', '".$bRate."', '".$cRate."', '".$dRate."', '".$eRate."', '".$fRate."', '".$gRate."', '".$hRate."', '".$iRate."', '".$jRate."')";

		if ($this->conn->query($sql) === TRUE) {
			return 1;
		} else {
			return 0;
		}
	}
	public function getRate($id){
		
			$sql= "SELECT * FROM rates where consigner_id= '$id' ";
			$result = $this->conn->query($sql);	
			$arr= array();
			
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$arr['aRate']= $row['a_rate'];
				$arr['bRate']= $row['b_rate'];
				$arr['cRate']= $row['c_rate'];
				$arr['dRate']= $row['d_rate'];
				$arr['eRate']= $row['e_rate'];
				$arr['fRate']= $row['f_rate'];
				$arr['gRate']= $row['g_rate'];
				$arr['hRate']= $row['h_rate'];
				$arr['iRate']= $row['i_rate'];
				$arr['jRate']= $row['j_rate'];
					
				}
			}
			//print_r($arr);
			return $arr;
		
			
	}
	
	function updateRate($arr){
		$flag= 0;
		$sql= "UPDATE rates SET";
		$r=0;
		if(isset($arr['aRate'])){
			if($r>0){
				$sql= $sql. ' ,';
			}
			$sql= $sql." a_rate= '".$arr['aRate']."'";
			$r++;
		}
		if(isset($arr['bRate'])){
			if($r>0){
				$sql= $sql. ' ,';
			}
			$sql= $sql." b_rate= '".$arr['bRate']."'";
			$r++;
		}
		if(isset($arr['cRate'])){
			if($r>0){
				$sql= $sql. ' ,';
			}
			$sql= $sql." c_rate= '".$arr['cRate']."'";
			$r++;
		}
		if(isset($arr['dRate'])){
			if($r>0){
				$sql= $sql. ' ,';
			}
			$sql= $sql." d_rate= '".$arr['dRate']."'";
			$r++;
		}
		if(isset($arr['eRate'])){
			if($r>0){
				$sql= $sql. ' ,';
			}
			$sql= $sql." e_rate= '".$arr['eRate']."'";
			$r++;
		}
		if(isset($arr['fRate'])){
			if($r>0){
				$sql= $sql. ' ,';
			}
			$sql= $sql." f_rate= '".$arr['fRate']."'";
			$r++;
		}
		if(isset($arr['gRate'])){
			if($r>0){
				$sql= $sql. ' ,';
			}
			$sql= $sql." g_rate= '".$arr['gRate']."'";
			$r++;
		}
		if(isset($arr['hRate'])){
			if($r>0){
				$sql= $sql. ' ,';
			}
			$sql= $sql." h_rate= '".$arr['hRate']."'";
			$r++;
		}
		if(isset($arr['iRate'])){
			if($r>0){
				$sql= $sql. ' ,';
			}
			$sql= $sql." i_rate= '".$arr['iRate']."'";
			$r++;
		}
		if(isset($arr['jRate'])){
			if($r>0){
				$sql= $sql. ' ,';
			}
			$sql= $sql." j_rate= '".$arr['jRate']."'";
			$r++;
		}
		$sql= $sql." WHERE consigner_id= '".$arr['id']."'";
		//echo $sql;
		if (mysqli_query($this->conn, $sql)) {
			$flag= 1;
		}
		return $flag;
	}
	
}

?>