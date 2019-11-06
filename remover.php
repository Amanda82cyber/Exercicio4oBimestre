<?php
	include("conexao.php");
	
	$id = $_POST["id"];
	$tabela = $_POST["tabela"];
	
	if($tabela == "cadastro")
	
	$remocao = "DELETE FROM $tabela WHERE id_$tabela = '$id'";
	
	// mysqli_error($conexao)
	mysqli_query($conexao,$remocao) or die("0".mysqli_error($conexao));
	
	echo "1";
?> 