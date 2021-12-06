<?php
/* Esse pedao de codigo pesquisa pelos ingredientes de uma determinada receita
 * É preciso que haja a passagem do parametro id_receita para a consulta
 */

//	array para armazenar a resposta JSON 
$response = array();

include_once("authentication.php");

$con = pg_connect(getenv("DATABASE_URL"));

if(isset($_GET['id_receita']) && !is_null($email) && !is_null($senha)) {
	if(authentication($email, $senha, $con)) {
		$id = $_GET['id_receita'];
		$query = "SELECT id_ingrediente, quantidade, unidade_medida.unidade_medida, insumo.nome_insumo as insumo, FK_RECEITA_id_receita as id_receita
		FROM ingrediente
		INNER JOIN insumo
			ON ingrediente.FK_INSUMO_id_insumo = insumo.id_insumo
		INNER JOIN unidade_medida
			ON ingrediente.FK_UNIDADE_MEDIDA_id_unidade_medida = unidade_medida.id_unidade_medida
		WHERE fk_RECEITA_id_receita = $id
		ORDER BY id_ingrediente ASC;";
		//	realizando a consulta
		$result = pg_query($con, $query);
		
		//	se houve resposta, crie o array json e envie para a app
		if(pg_num_rows($result) > 0) {
			$response['ingredientes'] = array();
			
			while($row = pg_fetch_array($result)) {
				$ingrediente = array();
				$ingrediente["id"] = $row["id_ingrediente"];
				$ingrediente["quantidade"] = $row["quantidade"];
				$ingrediente["unidade_medida"] = $row["unidade_medida"];
				$ingrediente["insumo"] = $row["insumo"];
				array_push($response["ingredientes"], $ingrediente);
			}
			
			$response["success"] = 1;
		}
		else {		
			$response["success"] = 0;
			$response["message"] = "Receita não encontrada";
		}
	}
	else {
		$response['success'] = 0;
		$response["message"] = "Autenticação requerida.";
	}
}
else {
	$response["success"] = 0;
	$response["message"] = "Faltam parâmetros";
}
pg_close($con);
echo json_encode($response);
?>