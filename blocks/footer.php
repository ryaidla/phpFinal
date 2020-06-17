
<footer  style=" background-color: black; height: 300px; padding-top:1px; width: 100% ">

    <div class="footer">
        <div></div>
        <div></div>
        <div></div>
        <div class="f1"> <h2>Future is HERE!</h2>

        </div>
        <div class="f2">

        </div>
        <div class="f3"> <form>
                <h3>To be Closer to the Future </h3>
                <h3>Add Your E-mail:</h3>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <input type="text" name="E-mail" >
                    <input type="submit" value="add" onclick="thankyou()"  style="color: black;"></input>
                </form>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $email = $_POST['email'] ;
        if (empty($email)  ) {
            echo "*Field should not be empty";
            return;
        }

        $sql = "INSERT INTO email_news (email) VALUES (?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $results = $stmt->execute();

        if ($results === false){
            echo $stmt->error;
        } else {
            $id = $stmt->insert_id;
            echo "Success";
        }

        $stmt->close();
    }
    ?>

</footer>