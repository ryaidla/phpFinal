<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>login </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <script type="text/javascript" src="js.js"></script>
</head>




<?php require "blocks/header.php" ?>

<div  class="container mt-5" >
		<?php if (empty($_SESSION['user'])): ?>
			<div class="row">
				<form class="col-md-4 bordered" id="signin-form">
					<div class="alert alert-danger"></div>
					<fieldset>
						<h2>Authorization</h2>
						<div class="form-group">
							<label for="exampleInputEmail">Email address</label>
							<input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="Entert Email" aria-describedby="emailHelp">
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword">Password</label>
							<input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
						</div>
						<div class="form-group form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
							<label class="form-check-label" for="exampleCheck1">Remember me</label>
						</div>
						<input type="text" name="form" value="signin" hidden>
						<button type="submit" class="btn btn-primary">Submit</button>
					</fieldset>
				</form>
			</div>

        <?php else: ?>
            <div style="padding-top: 100px">
                <div><img  src="<?= $_SESSION['user']['img'] ?>"></div>
                <h4 id="fullname"><?= $_SESSION['user']['name'] . ' ' . $_SESSION['user']['surname'] ?></h4>
                <br>
                <strong>Email: </strong><?= $_SESSION['user']['email'] ?><br>
                <strong>Birthday: </strong><?= $_SESSION['user']['birthday'] ?><br>
                <a href="logout.php" >Sign Out</a>
            </div>
        <?php endif ?>

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
						    console.log(data);
							if(data.reload){
								document.location.reload();
							}
						}
					});
				}
			<?php endif; ?>

			const i = $('#signin-form fieldset');




			const t = function t(f, n, m){
				f.find(n)
					.text(m)
					.fadeTo(2000, 500)
					.slideUp(500, function(){
						$(this).slideUp(500);
					});
			};

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


		});
	</script>

    <?php require "blocks/footer.php" ?>

</html>