<?php 

	$server_name = 'localhost';
	$user_name = 'etecia1';
	$password = '1234567';
	$db_name = 'dbEscola';

	$connection = new mysqli($server_name,$user_name,$password,$db_name);

	if ($connection->connect_error) {
		die("Erro ao conectar com o banco de dados: " . $connection->connect_error);
	}
