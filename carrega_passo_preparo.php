<?php
/* Esse pedao de codigo pesquisa pelos passos de preparo de uma determinada receita
 * É preciso que haja a passagem do parametro id_receita para a consulta
 */

//	array para armazenar a resposta JSON 
$response = array();

if(isset($_GET['id_receita'])) {
	$id = $_GET['id_receita'];
	
	//	conexao com o db
	include_once("config.php");
	$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");
	
	//	realizando a consulta
	$result = pg_query("
	SELECT instrucao FROM passo_preparo
	WHERE fk_RECEITA_id_receita = $id
	ORDER BY numero_sequencia ASC;");
	
	//	se houve resposta, crie o array json e envie para a app
	if(pg_num_rows($result) > 0) {
		$response['modo_preparo'] = array();
		
		while($row = pg_fetch_array($result)) {
			$passoPreparo = array();
			$passoPreparo["instrucao"] = $row["instrucao"];
			array_push($response["modo_preparo"], $passoPreparo);
		}
		
		// fecha a conexao com o BD
		pg_close($con);
		
		$response["success"] = 1;
		$response["message"] = "Modo de preparo carregado com sucesso";
		
		echo json_encode($response);		
	}
	else {
		// fecha a conexao com o BD
		pg_close($con);
		
		$response["success"] = 0;
		$response["message"] = "Receita não encontrada";
		
		echo json_encode($response);
	}
}
else {
	$response["success"] = 0;
	$response["message"] = "Receita não informada";
	
	echo json_encode($response);
}
?>