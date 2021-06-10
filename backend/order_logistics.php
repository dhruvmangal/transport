<?php

require_once 'dbconnect.php';

class Order extends Database{
	public function __construct(){
		parent::__construct();
		
	}
	public function createOrder($arr){
		$gst= $arr['totalAmount']- $arr['amount'];
		$sql= "INSERT INTO order_logistics (cnote, consigner, consignee, transport, zone, from_city, to_city, date, actual_weight, charged_weight, no_of_boxes, rate, cft, rsc, fsc, oda, freight, cn, green_tax, amount, cgst, sgst, total_amount, payment, order_time, order_date)
			values('".$arr['cnote']."','".$arr['consigner']."','".$arr['consignee']."','".$arr['transport']."','".$arr['zone']."','".$arr['from']."','".$arr['to']."', '".$arr['date']."','".$arr['acweight']."','".$arr['chargedWeight']."' ,'".$arr['boxes']."',".$arr['rate'].",".$arr['cft'].",".$arr['rsc'].", '".$arr['fsc']."', ".$arr['oda'].", '".$arr['freight']."',".$arr['cn'].",".$arr['greentax'].",".$arr['amount'].",".($gst/2).",".($gst/2).",".$arr['totalAmount'].", '".$arr['payment']."','".date('H:i:s')."','".date('y-m-d')."' )";
		//echo $sql;
		if ($this->conn->query($sql) === TRUE) {
			$id= $this->conn->insert_id;
			return $id;
		} else {
			return 0;
		}	
	}
	public function viewOrder($arr){
		$sql= "SELECT * FROM order_logistics";
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
				$sql= $sql." upper(consigner)= upper('".$arr['consigner']."')"; 
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
				$arr[$i]['consigner']=strtoupper($row['consigner']);
				$arr[$i]['consignee']=strtoupper($row['consignee']);
				$arr[$i]['transport']=strtoupper($row['transport']);
				$arr[$i]['zone']= strtoupper($row['zone']);
				$arr[$i]['from']=strtoupper($row['from_city']);
				$arr[$i]['to']= strtoupper($row['to_city']);
 				$arr[$i]['date']=$row['date'];
				$arr[$i]['actual_weight']= $row['actual_weight'];
				$arr[$i]['charged_weight']= $row['charged_weight'];
				$arr[$i]['boxes']= $row['no_of_boxes'];
				$arr[$i]['rate']= $row['rate'];
				$arr[$i]['cft']= $row['cft'];
				$arr[$i]['rsc']= $row['rsc'];
				$arr[$i]['fsc']= $row['fsc'];
				$arr[$i]['oda']= $row['oda'];
				$arr[$i]['freight']= $row['freight'];
				$arr[$i]['cn']= $row['cn'];
				$arr[$i]['green_tax'] = $row['green_tax'];
				$arr[$i]['amount'] = $row['amount'];
				$arr[$i]['cgst'] = $row['cgst'];
				$arr[$i]['sgst'] = $row['sgst'];
				$arr[$i]['total_amount'] = $row['total_amount'];
				$arr[$i]['payment']= strtoupper($row['payment']);
				$i++;
			}
		}
		return $arr;
	}
	public function deleteOrder(){
		
	}
	public function editOrder($arr){
		$sql= "UPDATE order_logistics SET";
		$r=0;
		if(isset($arr['payment'])){
			if($r>0){
				$sql=$sql.', ';
			}
			$sql= $sql." payment= '".$arr['payment']."'";
			
			$r++;
		}
		
		$sql= $sql." WHERE order_id= '".$arr['id']."'";
		if(mysqli_query($this->conn, $sql)){
			return 1;
		}else{
			return 0;
		}
	
	}
	
	public function getConsigners(){
		$sql= "SELECT DISTINCT consigner from order_logistics";
		$result = $this->conn->query($sql);	
		$arr= array();
		$i= 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				
				$arr[$i]=$row['consigner'];
				$i++;
			}
		}
		return $arr;	
	}
	public function getConsignees(){
		$sql= "SELECT DISTINCT consignee from order_logistics";
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