<?php
	include("conexao.php");
	
	$id = $_POST["id"];
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$sexo = $_POST["sexo"];
	$cid = $_POST["cid"];
	$salario = $_POST["salario"];
	
	$update = "UPDATE cadastro SET nome = '$nome', email= '$email', sexo = '$sexo', cod_cidade = '$cid', salario = '$salario' WHERE id_cadastro = $id";
	
	mysqli_query($conexao, $update) or die("0" .mysqli_error($conexao));
	
	echo "1";
?>