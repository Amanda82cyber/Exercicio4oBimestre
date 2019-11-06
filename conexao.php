<?php
	$local = "localhost:3307";
	$usuario = "root";
	$senha = "usbw";
	$bd = "ex_4obimestre";
	
	$conexao = mysqli_connect($local, $usuario, $senha, $bd) or die ("Erro de conexão!");
	
	mysqli_set_charset($conexao,"utf8");
?>