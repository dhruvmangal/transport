<?php

require_once 'order_logistics.php';
//print_r($_POST);
if(isset($_POST['method']))
{
	switch($_POST['method']){
		
		case 'create':
			$arr= array();
			$arr= $_POST;
			$order= new Order();
			$id= $order->createOrder($arr);
			echo json_encode($id);
		break;
		
		case 'view':
			
		break;
		
		case 'viewAll':
			$arr= array();
			$arr= $_POST;
			$order= new Order();
			$api= $order->viewOrder($arr);
			echo json_encode($api);
		break;
		
		case 'delete':
		break;
		
		case 'update':
			$order= new Order();
			$api= $order->editOrder($_POST);
			echo json_encode($api);
		break;
		
		case 'consigner':
			$order= new Order();
			$api= $order->getConsigners();
			echo json_encode($api);
			break;
			
		case 'consignee':
			$order= new Order();
			$api= $order->getConsignees();
			echo json_encode($api);
			break;
	}
}
?>
