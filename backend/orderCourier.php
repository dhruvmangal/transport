<?php
require_once 'dbconnect.php';

class OrderCourier extends Database{
	
	function __construct(){
		parent::__construct();
	}
	function createOrder($arr){
		$sql= "INSERT INTO order_courier (cnote, consignor, consignee, transport, city, date, weight, boxes, rate, amount, gst, total_amount, order_time, order_date)
			VALUES ('".$arr['cnote']."','".$arr['consignor']."','".$arr['consignee']."','".$arr['transport']."','".$arr['city']."','".$arr['date']."','".$arr['weight']."', '".$arr['boxes']."', '".$arr['rate']."','".$arr['amount']."','".$arr['gst']."','".$arr['total_amount']."','".date('H:i:s')."','".date('y-m-date')."')";
			
		if ($this->conn->query($sql) === TRUE) {
			$id= $this->conn->insert_id;
			return $id;
		} else {
			return 0;
		}		
	}
	function viewOrder($arr){
		$sql= "SELECT * FROM order_courier";
		$r=0;
		if(!empty($arr['cnote']) or !empty($arr['consigner']) or !empty($arr['consignee']) or !empty($arr['to']) or !empty($arr['from'])){
			$sql= $sql.' where';
			if(isset($arr['cnote']) and !empty($arr['cnote']) ){
				if($r>0){
					$sql= $sql.' and';
				}
				$sql= $sql." cnote= '".$arr['cnote']."'"; 
				$r++;
				
			}
			if(isset($arr['consigner']) and !empty($arr['consigner'])){
				if($r>0){
					$sql= $sql.' and';
				}
				$sql= $sql." upper(consignor)= upper('".$arr['consigner']."')"; 
				$r++;
			}
			if(isset($arr['consignee']) and !empty($arr['consignee'])){
				if($r>0){
					$sql= $sql.' and';
				}
				$sql= $sql." upper(consignee)= upper('".$arr['consignee']."')"; 
				$r++;
			}
			if(isset($arr['to']) and !empty($arr['to'])){
				if($r>0){
					$sql= $sql.' and';
				}
				$sql= $sql." date >= '".$arr['from']."' AND date <= '".$arr['to']."'"; 
				$r++;
			}
			//echo $sql;
		}
		
		$result = $this->conn->query($sql);	
		$arr= array();
		$i=0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$arr[$i]['id']= $row['order_id'];
				$arr[$i]['cnote']= $row['cnote'];
				$arr[$i]['consigner']=strtoupper($row['consignor']);
				$arr[$i]['consignee']=strtoupper($row['consignee']);
				$arr[$i]['transport']=strtoupper($row['transport']);
				$arr[$i]['to']=strtoupper($row['city']);
				$arr[$i]['from']=strtoupper('jaipur');
				$arr[$i]['date']=$row['date'];
				$arr[$i]['weight']= $row['weight'];
				$arr[$i]['boxes']= $row['boxes'];
				$arr[$i]['rate']= $row['rate'];
				$arr[$i]['amount'] = $row['amount'];
				$arr[$i]['cgst'] = ($row['total_amount']-$row['amount'])/2;
				$arr[$i]['sgst'] = ($row['total_amount']-$row['amount'])/2;
				$arr[$i]['total_amount'] = $row['total_amount'];
				$i++;
			}
		}
		return $arr;
	}
	
	public function getConsigners(){
		$sql= "SELECT DISTINCT consignor from order_courier";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i= 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				
				$arr[$i]=$row['consignor'];
				$i++;
			}
		}
		return $arr;	
	}
	public function getConsignees(){
		$sql= "SELECT DISTINCT consignee from order_courier";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i= 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				
				$arr[$i]=$row['consignee'];
				$i++;
			}
		}
		return $arr;
	}
}

?>