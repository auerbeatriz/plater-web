<?php
// This peace of code search for all the recipes inserted on the database and returns it to the client as a json


// connecting to db
$con = pg_connect(getenv("DATABASE_URL"));
//$con = pg_connect("host=ec2-23-23-181-251.compute-1.amazonaws.com port=5432 dbname=d8555packlsg7v user=eavhbkmnummpuu password=1baeed6108ff9934e01b35c66392a5f5df008f84e86bafed1720ae41f86eba4b");
 
// array for JSON response
$response = array();
$id = 2;

$_GET['username'] = 'plater_chef';
$_GET['senha'] = '36d49c9b8283b3590023391f3801a1ab';

//	Verifica se o usuario esta logado no sistema
if (isset($_GET["username"]) && isset($_GET["senha"])) {
		
		$result = pg_query($con, "SELECT id_receita, titulo_receita, descricao_receita, tempo_preparo, rendimento, tipo_rendimento.tipo_rendimento as tipo_rendimento, multimidia, 
								tipo_multimidia, categoria.descricao as categoria FROM receita
								INNER JOIN categoria ON receita.fk_categoria_id_categoria = categoria.id_categoria
								INNER JOIN tipo_rendimento ON receita.fk_tipo_rendimento_id_tipo_rendimento = tipo_rendimento.id_tipo_rendimento
								WHERE id_receita = $id;");
		
		//	Se existirem receitas no bd, eles serão armazenados na chave "recipes" de $response e a chave "success" receberá o valor 1
		
		if (pg_num_rows($result) > 0) {
			$response["recipes"] = array();
			
			while ($row = pg_fetch_array($result)) {
				$recipe = array();
				$recipe['id_receita'] = $row['id_receita'];
				$recipe['titulo_receita'] = $row['titulo_receita'];
				$recipe['descricao_receita'] = $row['descricao_receita'];
				$recipe['tempo_preparo'] = $row['tempo_preparo'];
				$recipe['rendimento'] = $row['rendimento'];
				$recipe['tipo_rendimento'] = $row['tipo_rendimento'];
				$recipe['multimidia'] = $row['multimidia'];
				$recipe['tipo_multimidia'] = $row['tipo_multimidia'];
				$recipe['categoria'] = $row['categoria'];
				
				array_push($response["recipes"], $recipe);
			}
			
			$response["success"] = 1;
			$response["message"] = "entrou no primeiro if";
 
			// Converte a resposta para o formato JSON.
			echo json_encode($response);
		} else {
			// Caso nao tenham receitas no bd, a chave success é 0 e o cliente recebe a mensagem do erro
			$response["success"] = 0;
			$response["message"] = "Ainda nao existem receitas";
		 
			// Converte a resposta para o formato JSON.
			echo json_encode($response);
		}
} else {
	$response["success"] = 0;
	$response["message"] = "Voce nao esta logado";
	
	pg_close($con);
	
	// Converte a resposta para o formato JSON.
	echo json_encode($response);
}
?>