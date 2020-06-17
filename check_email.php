<?php

require_once 'config.php';
require_once 'Db.php';

if(!empty($_POST['email'])){
	$email = htmlspecialchars($_POST['email']);

	try {
		$db = Db::getInstance();
		$connection = $db->getConnection();

		$stmt = $connection->prepare('SELECT id FROM users WHERE email = ?');
		$stmt->bind_param('s', $email);

		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows == 0){
			$response = [
				'success' => 'Email is not taken.'
			];
		} else {
			$response = [
				'error' => 'Email already taken'
			];
			http_response_code(400);
		}
	} catch(ErrorException $e){
		$response = [
			'error' => $e->getMessage()
		];
		http_response_code(500);
	}
	$stmt->close();
	$connection->close();
} else {
	$response = [
		'error' => 'Please, send email'
	];
	http_response_code(403);
}