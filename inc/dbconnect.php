<?php
include("env.php");

try {
  $conn = new PDO("mysql:host=$DB_SERVER;dbname=bringmit", $DB_USER, $DB_PASSWORD);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
