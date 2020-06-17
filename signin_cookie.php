<?php

require_once 'config.php';
require_once 'Db.php';

$cookie_token = !empty($_COOKIE['cookie_token']) ? $_COOKIE['cookie_token'] : null;

if(!!$cookie_token){
	try {
		$db = Db::getInstance();
		$connection = $db->getConnection();

		$stmt = $connection->prepare('SELECT * FROM users WHERE cookie_token = ? LIMIT 1');
		$stmt->bind_param('s', $cookie_token);

		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows != 0){
			$_SESSION['user'] = $result->fetch_assoc();
			$response = [
				'reload' => true
			];
		} else {
			$response = [
				'error' => 'something=))'
			];
			http_response_code(500);
		}
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
	http_response_code(400);
}