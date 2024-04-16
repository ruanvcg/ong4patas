<?php
	$servername = "mysql-cuidadores4patas.alwaysdata.net";
	$username = "289041";
	$password = "4Patas2022";
	$dbname = "cuidadores4patas_ong";

	// Cria uma conexão com as credenciais, note que não estamos fechando a mesma
	$conn = new mysqli($servername, $username, $password, $dbname);

	//O trecho abaixo verifica se existem erros, compatível com PHP >= 5.3
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error); //encerra o script por completo
	}
?>