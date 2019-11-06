<!DOCTYPE html>

<html lang = "pt-BR">
	<head>
		<title>Cadastrar Cidade</title>
		<meta charset = "UTF-8" />
		<script src = "jquery-3.4.1.min.js"></script>
		<script>
			var id = null
			var filtro = null
			$(document).ready(function(){
				paginacao(0);
				
				// CADASTRAR
				
				$(document).on("click", ".cadastrar", function(){
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
						data: {pg: p, nome_filtro: filtro},
						success: function(matriz){
							$("#tb").html("");
							for(i=0;i<matriz.length;i++){
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
				
				// FILTRAR
				
				$("#filtrar").click(function(){
					$.ajax({
						url: "paginacao_cidade.php",
						type: "post",
						data:{nome_filtro: $("input[name='nome_filtro']").val()},
						success: function(d){
							$("#paginacao").html(d);
							filtro = $("input[name='nome_filtro']").val();
							paginacao(0);
						}
					});
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
						data: {id: id, nome: $("#nome_cidade").val(), cod_est: $("select[name = 'estado']").val()},
						success: function(data){
							if(data==1){
								$("#msn").html("Cadastro alterado com sucesso!");
								paginacao(0);
								$("#nome_cidade").val("");
								$("select[name = 'estado']").val("");
								$(".alteracao").attr("class", "cadastrar");
								$(".cadastrar").val("Cadastrar...");
							}else{
								$("#msn").html("Não foi possível alterar o cadastro desta cidade!");
							}
						}
					});
				});
				
				// ALTERAÇÃO POR CAMPO
				
				// Nome
				
				$(document).on("click",".nome",function(){
					td = $(this);
					nome = td.html();
					td.html("<input type = 'text' id = 'nome_alterar' name = 'nome' value = '" + nome + "' />");
					td.attr("class", "nome_alterar");
					$("#nome_alterar").focus();
				});

				$(document).on("blur",".nome_alterar",function(){
					td = $(this);
					id_linha = $(this).closest("tr").find("button").val(); //pego a linha mais perto e busco o valor da mesma
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {sort: 'cidade', coluna: 'nome', valor: $("#nome_alterar").val(), id: id_linha},
						success: function(){
							nome = $("#nome_alterar").val();
							td.html(nome);
							td.attr("class", "nome");
						},
					});
				});
				
				// Estado
				
				$(document).on("click",".estado",function(){
					td = $(this);
					estado = td.html();
					select = "<select id = 'estado_alterar'>";
					select += $("select[name = 'estado']").html();
					select += "</select>";
					td.html(select);
					valor = $("option:contains('" + estado + "')").val();
					$("#estado_alterar").val(valor);
					td.attr("class", "estado_alterar"); 
				});
				
				$(document).on("blur",".estado_alterar",function(){
					td = $(this);
					id_linha = $(this).closest("tr").find("button").val(); //pego a linha mais perto e busco o valor da mesma
					$.ajax({
						url: "alterar_coluna.php",
						type: "post",
						data: {sort: 'cidade', coluna: 'cod_estado', valor: $("#estado_alterar").val(), id: id_linha},
						success: function(){
							cod_estado = $("#estado_alterar").val();
							estado = $("#estado_alterar").find("option[value = '" + cod_estado + "']").html();
							td.html(estado);
							td.attr("class", "estado");
						},
					});
				});
				
				// REMOVER
				
				$(document).on("click",".remover",function(){
					id = $(this).attr("value"); 
					$.ajax({
						url: "remover.php",
						type: "post",
						data: {tabela: 'cadastro', id: id},
						success: function(data){
							if(data==1){
								$("#msg").html("Remoção realizada com sucesso!");
								$("#msg").css("color", "green");
							}else{
								$("#msg").html("Não foi possível realizar essa remoção!");
								$("#msg").css("color", "red");
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
			
			echo "Estado: <select name = 'estado'>";
			
			while($linha = mysqli_fetch_assoc($result)){
				echo '<option value = "'.$linha["id_estado"].'">'.$linha["nome"].'</option>';
			}
			
			echo "</select><br/><br/>";
		?>
		
		<input type = "button" class = "cadastrar" value = "Cadastrar..." /><br/><br/>
		
		<div id = "msn"></div><br/><br/>
		
		<h3>Filtrar:</h3><br/>
		
		<form name = "filtro" >
			<input type = "text" name = "nome_filtro" placeholder = "Filtrar por nome..." />
			<button type = "button" id = "filtrar">Filtrar</button>
		</form>
		
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
		
		<div id = "paginacao">
			<?php
				include("paginacao_cidade.php");
			?>
		</div>	
		
		<br/><br/><a href = "cadastro_pessoas.php">Cadastrar Pessoas</a><br/><br/>
		<a href = "cadastra_estado.php">Cadastrar Estados</a>
	</body>
</html>