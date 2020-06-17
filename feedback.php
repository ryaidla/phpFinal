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
	<title></title>

	<script type="text/javascript" src="js.js"></script>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body style="margin:0; ">

<?php require "blocks/header.php" ?>


<div id="onas" style=" background-color: #4443; height: 500px; width: 50%; text-align: center; margin-left: 380px;margin-top: 150px;">


    <div>
        <h1>Start</h1>
        <p>Please fill in this form start your journey in programming.</p>
        <hr>

        <form method="POST" >

            <input type="text" name="email" placeholder="Enter Email"  >

            <input type="text" name="number" placeholder="Enter Your Number"  >

            <input type="text" name="name" placeholder="Enter Your name"  >

            <input type="submit" value="Register">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            $email = $_POST['email'] ;
            $number = $_POST['number'];
            $name = $_POST['name'];
            if (empty($email)  ) {
                echo "*Fields should not be empty";
                return;
            }

            $sql = "INSERT INTO students (email, number, name) VALUES (?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $email, $number, $name);
            $results = $stmt->execute();

            if ($results === false){
                echo $stmt->error;
            } else {
                $id = $stmt->insert_id;
                echo "Successfully registered";
            }

            $stmt->close();
        }
        ?>


    </div>
</div>



<main style="height: 400px; padding-top: 100px;margin-top: 100px;text-align: center; ">
	<h1 style="color: black; ">You have questions?</h1>
	<h3 style="color: black; ">Contact us!</h3> 
	<p style="color:black ;"> Telephone Number: 8 (700) 255-01-17 </p>
	<p style="color: black; ">E-mail: futurecode@future.code</p> 
	<p style="color: black; ">Find us in social networks by this username: <strong>@Futurecode</strong></p>
</main>



<?php require "blocks/footer.php" ?>

</body>
</html>