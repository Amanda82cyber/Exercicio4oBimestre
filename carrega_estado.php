<?php
	header("Content-type: application/json");
	include("conexao.php");
	
	$p = $_POST["pg"];
	
	$sql = "SELECT * FROM estado"; 
	
	if(isset($_POST["nome_filtro"])){
		$nome = $_POST["nome_filtro"];
		$sql .= " WHERE nome LIKE '%$nome%'";
	}
	
	$sql .= " LIMIT $p,5";
	
	$resultado = mysqli_query($conexao,$sql);
	
	while($linha = mysqli_fetch_assoc($resultado)){
		$matriz[] = $linha;
	}
	
	echo json_encode($matriz);
?>