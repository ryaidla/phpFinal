<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <script type="text/javascript" src="js.js"></script>

</head>

<?php require "blocks/header.php" ?>


<body>

<div style="height: 900px; margin-left: 600px" class="container mt-11">
    <?php if (empty($_SESSION['user'])): ?>
        <div class="row">
            <form class="regist-form" id="signup-form">
                <fieldset disabled>
                    <div class="alert alert-danger"></div>
                    <div class="alert alert-success"></div>
                    <h2>Registration</h2>
                    <div class="regist-email">
                        <label for="exampleInputEmail1">Email address:</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
                    </div>
                    <div class="regist-name">
                        <label for="exampleInputFirstName">First Name:</label>
                        <input type="text" name="name" class="form-control" id="exampleInputFirstName" placeholder="Enter First Name">
                    </div>
                    <div class="regist-surname">
                        <label for="exampleInputSecondName">Second Name:</label>
                        <input type="text" name="surname" class="form-control" id="exampleInputSecondName" placeholder="Enter Second Name">
                    </div>
                    <div class="regist-passw">
                        <label for="exampleInputPassword1">Password:</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="regist-img">
                        <label for="exampleInputAvatar">URL Avatar:</label>
                        <input type="text" name="img" class="form-control" id="exampleInputAvatar" placeholder="Enter URL">
                    </div>
                    <div class="regist-birth">
                        <label for="exampleInputBirthday">Birthday:</label>
                        <input type="date" name="birthday" class="form-control" id="exampleInputBirthday">
                    </div>
                    <input type="text" name="form" value="signup" readonly hidden>
                    <button type="submit" class="btn btn-success">Submit:</button>
                </fieldset>
            </form>
        </div>
    <?php else: ?>
        <div class="text-center">
            <div class="autho-img" style="background-image: url(<?= $_SESSION['user']['img'] ?>);width:300px; background-size: cover;"></div>
            <h4 id="fullname"><?= $_SESSION['user']['name'] . ' ' . $_SESSION['user']['surname'] ?></h4>
            <br>
            <strong>Email: </strong><?= $_SESSION['user']['email'] ?><br>
            <strong>Birthday: </strong><?= $_SESSION['user']['birthday'] ?><br>
            <a href="logout.php" class="btn btn-primary mt-5">Sign Out</a>
        </div>
    <?php endif ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script>
    $(document).ready(function(){
        <?php if(empty($_SESSION['user'])): ?>
        if($.cookie('cookie_token')){
            $.ajax({
                url: 'server.php',
                method: 'post',
                data: { form: 'signin_cookie' },
                success: function(data){
                    if(data.reload){
                        document.location.reload();
                    }
                }
            });
        }
        <?php endif; ?>

        const i = $('#signin-form fieldset');
        const u = $('#signup-form fieldset');

        const h = function h(f, s){
            f.parent().addClass('bordered');
            s.parent().removeClass('bordered');
            f.prop('disabled', null);
            s.prop('disabled', 'true');
        };

        const t = function t(f, n, m){
            f.find(n)
                .text(m)
                .fadeTo(2000, 500)
                .slideUp(500, function(){
                    $(this).slideUp(500);
                });
        };

        $('#exampleInputEmail1').blur(function(){
            const email = $(this).val();
            $.ajax({
                url: 'server.php',
                method: 'post',
                data: { email: email, form: 'check_email' },
                beforeSend: function(){
                    $('#email_check-response').css('color', '#6c757d').text('Loading data...');
                },
                success: function(data){
                    $('#email_check-response').css('color', '#28a745').text(data.success);
                },
                error: function(err){
                    $('#email_check-response').css('color', '#dc3545').text(err.responseJSON.error);
                }
            });
        });

        $('form').submit(function(e){
            e.preventDefault();
            const s = $(this);
            $.ajax({
                url: 'server.php',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data){
                    if(data.reload){ document.location.reload(true); }
                    s.get(0).reset();
                    t(s, '.alert-success', data.success);
                },
                error: function(err){
                    t(s, '.alert-danger', err.responseJSON.error);
                }
            });
        });

        $('#signin-form').click(function(){ h(i, u); });
        $('#signup-form').click(function(){ h(u, i); });
    });
</script>

<?php require "blocks/footer.php" ?>

</body>
</html>