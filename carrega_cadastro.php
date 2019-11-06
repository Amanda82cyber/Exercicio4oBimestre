<?php
	header("Content-type: application/json");
	include("conexao.php");
	
	$p = $_POST["pg"];
	
	$sql = "SELECT c.id_cadastro as id_cadastro,
				   c.nome as nome, 
				   c.email as email, 
				   c.sexo as sexo, 
				   c.salario as salario, 
				   ci.nome as cidade
			FROM cadastro c
			INNER JOIN cidade ci
			ON c.cod_cidade = ci.id_cidade"; 
	
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