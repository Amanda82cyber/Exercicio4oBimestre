<?php
	include("conexao.php");
	
	$id = $_POST["id"];
	$nome = $_POST["nome"];
	$cod = $_POST["cod_est"];
	
	$update = "UPDATE cidade SET nome = '$nome', cod_estado = '$cod' WHERE id_cidade = $id";
	
	mysqli_query($conexao, $update) or die("0" .mysqli_error($conexao));
	
	echo "1";
?>