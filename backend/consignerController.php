<?php

require_once 'consigner.php';

$api= array();
$consigner= new Consigner();
if(isset($_POST['method'])){
	
	switch($_POST['method']){
		case 'create':
			if(isset($_POST['name']) and isset($_POST['addr1']) and isset($_POST['addr2']) and isset($_POST['cft']) and isset($_POST['fsc']) and isset($_POST['rov']) and isset($_POST['oda'])){
				$result= $consigner->createConsigner($_POST);
				echo $result;	
			}
		break;
		case 'view':
			if(isset($_POST['id'])){
				$api= $consigner->getConsigner($_POST['id']);
				echo json_encode($api);
			}
		break;
		case 'viewAll':
			$api= $consigner->getConsigners();
			echo json_encode($api);
		break;
		
		case "update":
			
			
				
				$api= $consigner->updateConsigner($_POST);
				echo $api;	
			
		break;
		case 'updateRate':
			$api= $consigner->updateRate($_POST);
				echo $api;
		break;
		case 'viewNames':
			$api= $consigner->getNames();
			echo json_encode($api);
		break;
		
		case 'viewRate':
			$api= $consigner->getRate($_POST['id']);
			echo json_encode($api);
		default:
		break;
	}
}
?>