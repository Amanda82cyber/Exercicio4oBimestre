<?php
	include("conexao.php");
	
	$id = $_POST["id"];
	$nome = $_POST["nome"];
	$uf = $_POST["uf"];
	
	$update = "UPDATE estado SET nome = '$nome', uf = '$uf' WHERE id_estado = $id";
	
	mysqli_query($conexao, $update) or die("0" .mysqli_error($conexao));
	
	echo "1";
?>