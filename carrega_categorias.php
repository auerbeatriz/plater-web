<?php

$response = array();

include_once("authentication.php");

$con = pg_connect(getenv("DATABASE_URL"));

if(!is_null($email) && !is_null($senha) && isset($_GET['lastCategory'])) {
    if(authentication($email, $senha, $con)) {
        $lastCategory = $_GET['lastCategory'];
        $query = "SELECT * FROM categoria WHERE id_categoria > $lastCategory ORDER BY id_categoria ASC;";
        $result = pg_query($con, $query);

        if(pg_num_rows($result) > 0) {
            $response["categories"] = array();

            while($row = pg_fetch_array($result)) {
                $categoria = array();
                $categoria['id_categoria'] = $row['id_categoria'];
                $categoria['categoria'] = $row['descricao'];
                $categoria["img_categoria"] = $row['img_categoria'];

                array_push($response['categories'], $categoria);
            }
            $response['success'] = 1;
        }
        else {
            $response['success'] = 0;
            $response['message'] = "Não existem categorias a serem carregadas";
        }
    }
    else {
        $response['success'] = 0;
        $response['message'] = "Autenticação requerida.";
    }
}
else {
    $response['success'] = 0;
    $response['message'] = "Faltam parâmetros";
}

pg_close($con);
echo json_encode($response);
?>