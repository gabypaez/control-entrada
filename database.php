<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'registro';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
$conexion = mysqli_connect('localhost', 'root', '', 'registro');
?>
