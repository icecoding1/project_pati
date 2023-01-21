<?php
$dns = 'mysql:host=localhost;dbname=system_managefood';
$username = 'root';
$password = '';

// Create connection
try {
  $obj = new PDO($dns, $username, $password);
} catch (PDOException $e) {
  die($e->getMessage());
}
