<?php

require_once 'config.php';
require_once 'Db.php';


$email = !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
$name = !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
$surname = !empty($_POST['surname']) ? htmlspecialchars($_POST['surname']) : null;
$password = !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : null;
$img = !empty($_POST['img']) ? htmlspecialchars($_POST['img']) : null;
$birthday = !empty($_POST['birthday']) ? htmlspecialchars($_POST['birthday']) : null;

if($email && $name && $surname && $password && $img && $birthday){
	try {
		$db = Db::getInstance();
		$connection = $db->getConnection();

		$stmt = $connection->prepare('INSERT INTO users (name, surname, email, password, img, birthday) 
																	VALUES (?, ?, ?, ?, ?, ?)');
		$stmt->bind_param('ssssss', $name, $surname, $email, $password, $img, $birthday);

		if(!$stmt->execute()){
			$response = [
				'error' => $stmt->error
			];
			http_response_code(400);
		} else {
			$response = [
				'success' => 'User has been created. Now you can login.'
			];
		}

		$stmt->close();

	} catch(ErrorException $e){
		$response = [
			'error' => $e->getMessage()
		];
		http_response_code(500);
	}
} else {
	$response = array(
		'error' => 'Fill all fields'
	);
	http_response_code(400);
}
