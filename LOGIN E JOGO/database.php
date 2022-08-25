<?php
$server = 'localhost';
$username = 'usuario';
$password = 'senha';
$database = 'nome do banco';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}