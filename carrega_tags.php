<?php
/* Esse pedaço de codigo pesquisa por todas as receitas que existem no banco de dados e as devolve para o cliente em formato json */

// connecting to db
$con = pg_connect(getenv("DATABASE_URL"));
include_once("authentication.php");

// array for JSON response
$response = array();
if(!is_null($email) && !is_null($senha)) {
	if(authentication($email, $senha, $con)) {
		$query = "SELECT * FROM tag;";
		$result = pg_query($con, $query);
		
		if (pg_num_rows($result) > 0) {
			$response["tags"] = array();
			
			while ($row = pg_fetch_array($result)) {
				$tag = array();
				$tag['id_tag'] = $row['id_tag'];
				$tag['nome_tag'] = $row['nome_tag'];
				
				array_push($response["tags"], $tag);
			}
			
			$response["success"] = 1;

		} else {
			$response["success"] = 0;
			$response["message"] = "Nenhuma tag para ser carregada";
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