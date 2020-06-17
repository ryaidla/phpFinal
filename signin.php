<?php

require_once 'config.php';
require_once 'Db.php';

if(!empty($_POST['email']) && !empty($_POST['password'])){
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	try {
		$db = Db::getInstance();
		$connection = $db->getConnection();
		$stmt = $connection->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
		$stmt->bind_param('ss', $email, $password);

		$stmt->execute();

		$result = $stmt->get_result();

		$response = $result->fetch_assoc();

		if($response == null){
			$response = array(
				'error' => 'Invalid credentials'
			);
			http_response_code(401);
		} else {
			if(!empty($_POST['remember']) && $_POST['remember'] == 'on'){
				$stmt->close();
				$cookie_token = uniqid();
				$stmt = $connection->query('UPDATE users SET cookie_token="' . $cookie_token . '" WHERE id=' . $response['id']);
				setcookie('cookie_token', $cookie_token, time() + 1209600);
			}
			$_SESSION['user'] = $response;

			$response = array(
				'reload' => true,
				'success' => 'You have logged in.'
			);
		}
		$connection->close();
	} catch(ErrorException $e){
		$response = [
			'error' => $e->getMessage()
		];
		http_response_code(500);
	}
} else {
	$response = [
		'error' => 'Something went wrong'
	];
	http_response_code(403);
}
