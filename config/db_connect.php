<?php 
  $connection = mysqli_connect('localhost', 'user', '1234', 'phpizza');
  if (!$connection) {
    echo 'Connection error: ' . mysqli_connect_error();
  }
?>