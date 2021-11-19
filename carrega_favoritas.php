<?php
/* Esse pedaço de codigo pesquisa por todas as receitas favoritadas pelo usuário e as devolve para o cliente em formato json */

// array for JSON response
$response = array();

// connecting to db
include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

include_once("authentication.php");

if(!is_null($username) && !is_null($senha)) {
    if(authentication($username, $senha, $con)) {
        $result = pg_query($con, "
        SELECT receita.id_receita, receita.titulo_receita, receita.descricao_receita, receita.tempo_preparo, receita.rendimento, tipo_rendimento.tipo_rendimento, categoria.descricao as categoria  FROM receita
		INNER JOIN categoria ON receita.fk_categoria_id_categoria = categoria.id_categoria
		INNER JOIN tipo_rendimento ON receita.fk_tipo_rendimento_id_tipo_rendimento = tipo_rendimento.id_tipo_rendimento
        INNER JOIN usuario_favorita_receita ON receita.id_receita = usuario_favorita_receita.fk_receita_id_receita
        WHERE usuario_favorita_receita.fk_usuario_username='$username';");

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
				$recipe['categoria'] = $row['categoria'];
				
				array_push($response["recipes"], $recipe);
			}
			
			$response["success"] = 1;
        }
        else {
            $response["success"] = 0;
			$response["message"] = "Seu livro de receitas está vazio.";
        }
    }
    else {
        $response["success"] = 2;
		$response["message"] = "Você ainda não está logado";
    }
}
else {
    $response["success"] = 0;
    $response["message"] = "Faltam parâmetros.";
}

pg_close($con);
echo json_encode($response);
?>