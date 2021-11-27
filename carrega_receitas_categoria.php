<?php

$response = array();

include_once("config.php");
include_once("authentication.php");

$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

if(!is_null($email) && !is_null($senha) && isset($_GET['categoria'])) {
    if(authentication($email, $senha, $con)) {
        $categoria = $_GET['categoria'];
        $query = "SELECT id_receita FROM receita WHERE fk_categoria_id_categoria=$categoria;";
        $result = pg_query($con, $query);

        if (pg_num_rows($result) > 0) {
            $response["recipes"] = array();
            
            //	para cada tupla no banco de dados, cria um array com os dados da receita e indexa-o na chave "recipes" de response
            while ($row = pg_fetch_array($result)) {
                $recipe = array();
                $recipe['id_receita'] = $row['id_receita'];
                
                array_push($response["recipes"], $recipe);
            }
            
            $response["success"] = 1;
        }
        else {
            $response["success"] = 0;
            $response["message"] = "Não existem receitas nessa categoria.";
        }
    }
    else {
        $response['success'] = 0;
        $response['message'] = "Autenticação requerida.";
    }
}
else {
    $response['success'] = 0;
    $response['message'] = "Faltam parâmetros.";
}

pg_close($con);
echo json_encode($response);

?>