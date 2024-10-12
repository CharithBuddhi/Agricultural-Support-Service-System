<?php
session_start();
if(isset($_GET['staff'])){
    unset($_SESSION['login_staff_id']);
    unset($_SESSION['login_staff_user']);
    unset($_SESSION['login_staff_type']);
    header('Location: index.php');
} 

if(isset($_GET['admin'])){
    unset($_SESSION['login_admin_id']);
    unset($_SESSION['login_admin_user']);
    unset($_SESSION['login_admin_type']);
    header('Location: index.php');
}

if(!isset($_GET['staff']) && !isset($_GET['admin'])){
    header('Location: index.php');
    exit();
}

?>