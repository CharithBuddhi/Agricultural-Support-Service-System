<?php

$con = mysqli_connect("localhost","root","","myagro");

if(!$con){
    die("Connection Failed: ".mysqli_connect_error());
}

$sql = "SELECT * FROM inquiry WHERE inquire_status = '1'";
$result = mysqli_query($con,$sql);

echo $result -> num_rows

?>