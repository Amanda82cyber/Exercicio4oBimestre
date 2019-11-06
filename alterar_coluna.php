<?php
	include("conexao.php");
	
	$coluna = $_POST["coluna"];
	$sort = $_POST["sort"];
	$valor = $_POST["valor"];
	$id = $_POST["id"];
	
	if($sort == "estado"){
		$update = "UPDATE estado SET $coluna = '$valor' WHERE id_estado = $id";
	}elseif($sort == "cadastro"){
		$update = "UPDATE cadastro SET $coluna = '$valor' WHERE id_cadastro = $id";
	}else{
		$update = "UPDATE cidade SET $coluna = '$valor' WHERE id_cidade = $id";
	}
	
	mysqli_query($conexao, $update) or die(mysqli_error($conexao));
	
	echo "1";
?>