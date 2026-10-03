<?php

$conn = mysqli_connect("localhost","root","","simple_crud");

if (!$conn) {

    die(
        "Database Connection Error: "
        . mysqli_connect_error()
    );

}else{
//echo "Connected";

}



?>