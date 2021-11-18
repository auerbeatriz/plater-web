<?php

$response = array();

include_once("config.php");
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

if(isset($_GET['id_categoria'])) {
    $categoria = $_GET['id_categoria'];

    $result = pg_query($con, "
    SELECT id_receita, titulo_receita, descricao_receita, tempo_preparo, rendimento, tipo_rendimento.tipo_rendimento, categoria.descricao as categoria  FROM receita
	INNER JOIN categoria ON receita.fk_categoria_id_categoria = categoria.id_categoria
	INNER JOIN tipo_rendimento ON receita.fk_tipo_rendimento_id_tipo_rendimento = tipo_rendimento.id_tipo_rendimento
    WHERE fk_categoria_id_categoria=$categoria;");

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
            $recipe['categoria'] = $row['categoria'];
            
            array_push($response["recipes"], $recipe);
        }
        
        $response["success"] = 1;
        $response["message"] = "receitas carregadas com sucesso";
    }
    else {
        $response["success"] = 0;
        $response["message"] = "Não existem receitas nessa categoria.";
    }
}
else {
    $response['success'] = 0;
    $response['message'] = "Categoria não informada";
}

pg_close($con);
echo json_encode($response);

?>