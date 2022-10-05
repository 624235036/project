<?php
// session_start();
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "project";

$conn = mysqli_connect("localhost", "root", "", "project" );
  // set the PDO error mode to exception
  if ($conn === false) {
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}
  
  mysqli_query( $conn, "SET NAMES UTF8" );

?>