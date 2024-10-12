<?php
session_start();
unset($_SESSION['login_id']);
unset($_SESSION['login_user']);
unset($_SESSION['login_type']);
session_destroy();
header('Location: index.php');
?>