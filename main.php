<?php
session_start();
$db_host = "localhost";
$db_name = "applications";
$db_user = "root";
$db_pass = "admin1";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully.";

?>

<!DOCTYPE html> 
<html>
<head>
	<title>Draft</title>
    <link rel="stylesheet" type="text/css" href="index.css">
	<script type="text/javascript" src="js.js"></script>
</head>
<body style="margin: 0px; background-color: black;">
<?php require "blocks/header.php"?>

<div id="main">
	<div  class="codewithus" style="background-image:
	url(https://images.wallpaperscraft.com/image/code_programming_symbols_140997_1920x1080.jpg); height: 100%;">
		<div class="www"></div>
		<div style="text-shadow: 0 0 50px; z-index: 99;">
			<h1>Future Digital Academy</h1>
			<a href="registration.php" ><button style="">Start</button>  </a>
		</div>
	</div>
</div>
<?php if(!empty($_SESSION['user'])): ?>
    <h1>Hello, <?= $_SESSION['user']['name']; ?></h1>
<?php else: ?>
    <h1>PLease, login</h1
<?php endif; ?>

<div  style="display: block; background-color: black">
    <h1 style="margin-left:40% ">Our cources</h1>

    <div>
        <div class="grid-container" >
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body bg-black text-white">
                        <h5><a href="infopage.php?id=1" class="card-title">C++</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5><a href="infopage.php?id=2" class="card-title">Pyton</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5><a href="infopage.php?id=3" class="card-title">Go</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5><a href="infopage.php?id=4" class="card-title">C#</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5><a href="infopage.php?id=5" class="card-title">Php</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5><a href="infopage.php?id=6" class="card-title">HTMl</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5><a href="infopage.php?id=7" class="card-title">Front End</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5><a href="infopage.php?id=8" class="card-title">Java</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5><a href="infopage.php?id=9" class="card-title">Data Science</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="cont">
    <?php require "blocks/footer.php" ?>
</div>
</body>
</html>