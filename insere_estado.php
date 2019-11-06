<?php
	include("conexao.php");
	
	$nome = $_POST["nome"];
	$uf = $_POST["uf"];
	
	$insert = "INSERT INTO estado(nome, UF) VALUES('$nome', '$uf')";
	
	mysqli_query($conexao, $insert) or die("0" .mysqli_error($conexao));
	
	echo "1";
?>