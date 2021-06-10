<?php
require_once 'user.php';


if(isset($_POST['method'])){
	$user= new User();
	switch($_POST['method']){
		case 'create': 
			$result= $user->createUser($_POST);
			echo $result;
		break;
		case 'update':
			$result= $user->updateUser($_POST['id'], $_POST['name'], $_POST['phone'], $_POST['email'] );
			echo json_encode($result);
			break;	
		break;
		case 'view': 
			$result= $user->getUser($_POST['id']);
			echo json_encode($result);
		break;
		case 'viewAll':
			$result= $user->getUsers();
			echo json_encode($result);
		break;
		case 'delete':
			$result= $user->deleteUser($_POST['id']);
			echo json_encode($result);
		break;
		
		case 'login':
			$result= $user->loginUser($_POST['phone'], $_POST['password']);
			echo json_encode($result);
			break;
		case 'changePassword':
			$result= $user->updatePassword($_POST['id'], $_POST['pwd'], $_POST['npwd'] );
			echo json_encode($result);
			break;
			
		
	}	
}


?>