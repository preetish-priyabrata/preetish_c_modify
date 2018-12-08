<?php

error_reporting(E_ALL);

$host = "localhost";
$db = "care_db_innovador";
$user = "preetish_ilab";
$password = "panindia@1112";

$pass = "panindia@1112";
$conn=mysqli_connect("$host","$user","$pass","$db");
if (!$conn){
echo "error in connection ".mysqli_error($conn);
}
