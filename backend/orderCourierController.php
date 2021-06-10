<?php
require_once 'orderCourier.php';

if(isset($_POST['method'])){
	
	switch($_POST['method']){
		
		case 'create':
			$order= new OrderCourier();
			$id= $order->createOrder($_POST);
			echo $id;
		break;

		case 'view':
			$order= new OrderCourier();
			$api= $order->viewOrder($_POST);
			echo json_encode($api);
		break;

		case 'delete':
		break;	
		
		case 'consigner':
			$order= new OrderCourier();
			$api= $order->getConsigners();
			echo json_encode($api);
			break;
			
		case 'consignee':
			$order= new OrderCourier();
			$api= $order->getConsignees();
			echo json_encode($api);
			break;
	}
	
	
}

?>