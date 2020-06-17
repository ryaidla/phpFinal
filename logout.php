<?php

session_start();
unset($_SESSION['user']);
unset($_COOKIE['cookie_token']);
setcookie('cookie_token', null, -1);
header("Location: login.php");