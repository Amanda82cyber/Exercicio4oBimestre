<!DOCTYPE html>

<html lang = "pt-BR">
	<head>
		<title>Cadastrar Cidade</title>
		<meta charset = "UTF-8" />
		<script src = "jquery-3.4.1.min.js"></script>
		<script>
			var id = null
		
			$(document).ready(function(){
				paginacao(0);
				
				// CADASTRAR
				
				$("#cad").click(function(){
					$.ajax({
						url: "insere_cidade.php",
						type: "post",
						data: {nome: $("#nome_cidade").val(), cod_estado: $("select[name = 'estado']").val()},
						success: function(data){
							if(data==1){
								$("#msg").html("Cadastro realizado com sucesso!");
								$("#msg").css("color", "green");
								paginacao(0);
							}else{
								$("#msg").html("Não foi possível cadastrar essa cidade!");
								$("#msg").css("color", "red");
							}
						}
					});
				});
				
				// PAGINAÇÃO
				
				function paginacao(p){
					$.ajax({
						url: "carrega_cidade.php",
						type: "post",
						data: {pg: p},
						success: function(matriz){
							$("#tb").html("");
							for(i=0;i<matriz.length;i++){
								console.log(matriz);
								linha = "<tr>";
								linha += "<td class = 'nome'>" + matriz[i].nome_cid + "</td>";
								linha += "<td class = 'estado'>" + matriz[i].nome_est + "</td>";
								linha += "<td><button type = 'button' class = 'alterar' value = '" + matriz[i].id_cidade + "'>Alterar</button> | <button type = 'button' class = 'remover' value = '" + matriz[i].id_cidade + "'>Remover</button></td>";
								linha += "</tr>";
								
								$("#tb").append(linha);
							}	
						}
					});
				}
				
				$(".pg").click(function(){
					p = $(this).val();
					p = (p-1)*5;
					paginacao(p);
				});
				
				// ALTERAÇÃO EM BLOCO
				
				$(document).on("click",".alterar",function(){
					id = $(this).attr("value"); 
					$.ajax({
						url: "carrega_cidades_alterar.php",
						type: "post",
						data: {id: id},
						success: function(vetor){
							$("#nome_cidade").val(vetor.nome);
							$("select[name = 'estado']").val(vetor.cod_estado);
							$(".cadastrar").attr("class","alteracao");
							$(".alteracao").val("Alterar cadastro");
						}
					});
				});
				
				$(document).on("click",".alteracao",function(){
					$.ajax({
						url: "alteracao_cidade.php",
						type: "post",
						data: {id: id, nome: $("#nome").val(), email: $("#email").val(), sexo: $("input[name='sexo']:checked").val(), salario: $("#salario").val(), cid: $(".id_cid").val()},
						success: function(data){
							if(data==1){
								$("#msn").html("Cadastro alterado com sucesso!");
								paginacao(0);
								$("#nome").val("");
								$("#email").val("");
								$("#salario").val("");
								$(".alteracao").attr("class", "cadastrar");
								$(".cadastrar").val("Cadastrar...");
							}else{
								$("#msn").html("Não foi possível alterar o cadastro desta pessoa!");
							}
						}
					});
				});
			});
		</script>
	</head>
	
	<body>
		<h3>Cadastro de Cidade:</h3><br/>
		
		Nome: <input type = "text" id = "nome_cidade" required = "required" /><br/><br/>
		
		<?php
			include("conexao.php");
			
			$consulta = "SELECT * FROM estado";
			
			$result = mysqli_query($conexao,$consulta) or die("ERRO!" .mysqli_error($conexao));
			
			echo "<select name = 'estado'>";
			
			while($linha = mysqli_fetch_assoc($result)){
				echo '<option value = "'.$linha["id_estado"].'">'.$linha["nome"].'</option>';
			}
			
			echo "</select><br/><br/>";
		?>
		
		<input type = "button" id = "cad" value = "Cadastrar..." /><br/><br/>
		
		<div id = "msg"></div><br/><br/>
		
		<h3>Listagem de Cidades:</h3><br/>
		
		<table border = "1">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Estado</th>
					<th>Ação</th>
				</tr>
			</thead>
			
			<tbody id = "tb"></tbody>
		</table><br/><br/>
		
		<?php
			include("paginacao_cidade.php");
		?>
	</body>
</html>