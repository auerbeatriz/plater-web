<?php
/* Esse pedaço de codigo pesquisa por todas as receitas favoritadas pelo usuário e as devolve para o cliente em formato json */

// array for JSON response
$response = array();

// connecting to db
$con = pg_connect(getenv("DATABASE_URL"));

include_once("authentication.php");

if(!is_null($email) && !is_null($senha) && isset($_GET['username'])) {
    if(authentication($email, $senha, $con)) {
        $username = trim($_GET['username']);
        $query = "SELECT fk_receita_id_receita as id_receita FROM usuario_favorita_receita WHERE usuario_favorita_receita.fk_usuario_username='$username';";
        $result = pg_query($con, $query);

        if (pg_num_rows($result) > 0) {
			$response["recipes"] = array();
            while ($row = pg_fetch_array($result)) {
				$recipe = array();
				$recipe['id_receita'] = $row['id_receita'];				
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