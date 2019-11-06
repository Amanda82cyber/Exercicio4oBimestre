<?php
	include("conexao.php");
	
	$nome = $_POST["nome"];
	$sexo = $_POST["sexo"];
	$email = $_POST["email"];
	$cid = $_POST["cid"];
	$salario = $_POST["salario"];
	
	$insert = "INSERT INTO cadastro(nome, sexo, email, cod_cidade, salario) VALUES('$nome', '$sexo', '$email', '$cid', '$salario')";
	
	mysqli_query($conexao,$insert) or die("0" . mysqli_error($conexao));
	
	echo "1";
?>