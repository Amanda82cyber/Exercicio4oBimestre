<?php
	header("Content-type: application/json");
	include("conexao.php");
	
	$p = $_POST["pg"];
	
	$sql = "SELECT c.nome as nome_cid, e.nome as nome_est, id_cidade
			FROM cidade c
			INNER JOIN estado e
			ON c.cod_estado = e.id_estado";
			
	if(isset($_POST["nome_filtro"])){
		$nome = $_POST["nome_filtro"];
		$sql .= " WHERE c.nome LIKE '%$nome%'";
	}
	
	$sql .= " LIMIT $p,5";
	
	$resultado = mysqli_query($conexao,$sql);
	
	while($linha = mysqli_fetch_assoc($resultado)){
		$matriz[] = $linha;
	}
	
	echo json_encode($matriz);
?>