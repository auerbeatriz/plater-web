<?php
/* Esse pedaço de codigo pesquisa por todas as receitas que existem no banco de dados e as devolve para o cliente em formato json */

// connecting to db
$con = pg_connect(getenv("DATABASE_URL"));
include_once("authentication.php");

// array for JSON response
$response = array();
if(isset($_GET['lastRecipe']) && !is_null($email) && !is_null($senha)) {
	if(authentication($email, $senha, $con)) {
		$lastRecipe = $_GET['lastRecipe'];
		$query = "SELECT id_receita, titulo_receita, descricao_receita, tempo_preparo, rendimento, tipo_rendimento.tipo_rendimento, categoria.id_categoria, categoria.descricao as categoria, multimidia, tipo_multimidia  FROM receita
		INNER JOIN categoria ON receita.fk_categoria_id_categoria = categoria.id_categoria
		INNER JOIN tipo_rendimento ON receita.fk_tipo_rendimento_id_tipo_rendimento = tipo_rendimento.id_tipo_rendimento
		WHERE id_receita > '$lastRecipe'
		ORDER BY id_receita;";
		$result = pg_query($con, $query);
		
		//	se existirem receitas no bd, eles serão armazenados na chave "recipes" de $response e a chave "success" receberá o valor 1
		if (pg_num_rows($result) > 0) {
			$response["recipes"] = array();
			
			//	para cada tupla no banco de dados, cria um array com os dados da receita e indexa-o na chave "recipes" de response
			while ($row = pg_fetch_array($result)) {
				$recipe = array();
				$recipe['id_receita'] = $row['id_receita'];
				$recipe['titulo_receita'] = $row['titulo_receita'];
				$recipe['descricao_receita'] = $row['descricao_receita'];
				$recipe['tempo_preparo'] = $row['tempo_preparo'];
				$recipe['rendimento'] = $row['rendimento'];
				$recipe['tipo_rendimento'] = $row['tipo_rendimento'];
				$recipe['id_categoria'] = $row["id_categoria"];
				$recipe['categoria'] = $row['categoria'];
				$recipe['url'] = $row['multimidia'];
				$recipe['urlType'] = $row['tipo_multimidia'];
				
				array_push($response["recipes"], $recipe);
			}
			
			$response["success"] = 1;

		} else {
			// Caso nao tenham receitas no bd, a chave success é 0 e o cliente recebe a mensagem do erro
			$response["success"] = 0;
			$response["message"] = "Nenhuma receita para ser carregada";
		}
	}
	else {
		$response["success"] = 0;
		$response["message"] = "Autenticação requeria";
	}
}
else {
	$response["success"] = 0;
	$response["message"] = "Faltam parâmetros";
}

pg_close($con);
echo json_encode($response);

?>