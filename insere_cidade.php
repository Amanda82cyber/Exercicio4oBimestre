<?php
	include("conexao.php");
	
	$nome = $_POST["nome"];
	$cod = $_POST["cod_estado"];
	
	$insert = "INSERT INTO cidade(nome, cod_estado) VALUES('$nome', '$cod')";
	
	mysqli_query($conexao, $insert) or die("0" .mysqli_error($conexao));
	
	echo "1";
?>