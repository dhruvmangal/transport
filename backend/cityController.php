<?php

require_once 'city.php';


$api= array();
$city= new City();
if(isset($_POST['method'])){
	
	switch($_POST['method']){
		case 'create':
			if(isset($_POST['name']) ){
				$greentax= 0;
				if(isset($_POST['greentax'])){
					$greentax= 1;
				}
				$result= $city->createCity($_POST['name'], $_POST['zone'], $greentax);
				echo $result;	
			}
		break;
		
		case 'view':
			if(isset($_POST['id'])){
				$api= $city->viewCity($_POST['id']);
				echo json_encode($api);
			}
		break;
		
		case 'viewAll':
			$api= $city->getCities();
			echo json_encode($api);
		break;
		
		case 'viewNames':
			$api= $city->getName();
			echo json_encode($api);
		break;
		
		case 'viewZone':
			if(isset($_POST['zone'])){
				$api= $city->getCityByZone($_POST['zone']);
				echo json_encode($api);
			}
			break;
		case 'update':
			
				$api= $city->updateCity($_POST);
				echo $api;	
			
		break;
		
		default:
		break;
	}
}
?>