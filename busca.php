<?php
$response = array();

include_once("config.php");
include_once("authentication.php");

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

if(!is_null($email) && !is_null($senha) && isset($_GET['texto'])) {
    if(authentication($email, $senha, $con)) {
        $busca = "%" . $_GET['texto'] . "%";
        $query = "SELECT id_receita, titulo_receita, descricao_receita, tempo_preparo, rendimento, tipo_rendimento.tipo_rendimento, categoria.descricao as categoria  FROM receita
        INNER JOIN tipo_rendimento ON receita.fk_tipo_rendimento_id_tipo_rendimento = tipo_rendimento.id_tipo_rendimento
        INNER JOIN categoria ON fk_categoria_id_categoria=categoria.id_categoria
        WHERE titulo_receita ILIKE '$busca' OR descricao_receita ILIKE '$busca' OR categoria.descricao ILIKE '$busca';";
        
        $result = pg_query($con, $query);
        if(pg_num_rows($result) > 0) {
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
            $response['success'] = 0;
            $response['message'] = "Sem resultados para essa busca.";
        }
    }
    else {
        $response['success'] = 0;
        $response['message'] = "Autenticação requerida.";
    }
}
else {
    $response['success'] = 0;
    $response['message'] = "Nenhum parâmetro de busca inserido.";
}

pg_close($con);
echo json_encode($response);
?>