<?php
$servername = "localhost";
$username = "app";
$password = "e*w*W9DhqRYnhuUy";

try {
  $conn = new PDO("mysql:host=$servername;dbname=bringmit", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
