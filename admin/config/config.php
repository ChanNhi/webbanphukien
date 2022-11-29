<?php
$mysqli = new mysqli("localhost","root","","webbanphukien");

// Check connection
if ($mysqli->connect_errno) {
  echo "Kết nói thật bại:" . $mysqli -> connect_error;
  exit();
}
else{
  mysqli_query($mysqli,"SET NAMES 'utf8'");
}
?>