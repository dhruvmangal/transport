<?php

require_once 'transport.php';

$api= array();
$transport= new Transport();
if(isset($_POST['method'])){
	
	switch($_POST['method']){
		case 'create':
			if(isset($_POST['name']) ){
				$result= $transport->createTransport($_POST['name']);
				echo $result;	
			}
		break;
		
		case 'view':
			if(isset($_POST['id'])){
				$api= $transport->viewTransport($_POST['id']);
				echo json_encode($api);
			}
		break;
		
		case 'viewAll':
			$api= $transport->viewTransports();
			echo json_encode($api);
		break;
		
		case 'update':
			if(isset($_POST['name'])){
				$api= $transport->updateTransport($_POST);
				echo $api;	
			}
		break;
		
		case 'viewNames':
			$api= $transport->nameTransports();
			echo json_encode($api);
		
		default:
		break;
	}
}
?>