<?php

include 'Db.php';

$id = $_GET['id'];

$connection = new mysqli('localhost', 'root', 'admin1', 'applications');;
$result = $connection->query('SELECT * FROM data WHERE id = ' . (int)$id);

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Page</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<?php require "blocks/header.php" ?>
<body>
	<div class="container">
		<h1><?= $row['title'] ; ?></h1>
		<h3><?= $row['text']; ?></h3>
	</div>
    <?php require "blocks/footer.php" ?>
</body>
</html>