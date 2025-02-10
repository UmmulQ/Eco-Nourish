<?php
$conn = mysqli_connect("localhost", "root", "", "eco_nourish");
if(mysqli_connect_error()){
    echo "<script> alert('can not connect to the database')</script>";
    exit();

}
?>