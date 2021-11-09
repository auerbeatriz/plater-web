
<?php
 
/*
 * O codigo seguinte retorna os dados detalhados de um produto.
 * Essa e uma requisicao do tipo GET. Um produto e identificado 
 * pelo campo pid.
 */
 
// array que guarda a resposta da requisicao
$response = array();
 
// Verifica se o parametro pid foi enviado na requisicao
if (isset($_GET["id_receita"])) {
	
	// Aqui sao obtidos os parametros
    $id_receita = $_GET['id_receita'];
	
	// Abre uma conexao com o BD.
	// DATABASE_URL e uma variavel de ambiente definida pelo Heroku, servico 
	// utilizado para fazer o deploy dessa aplicacao web. Ela 
	// contem a string de conexao necessaria para acessar o BD fornecido pelo 
	// Heroku. Caso voce nao utilize o servico Heroku, voce deve alterar a 
	// linha seguinte para realizar a conexao correta com o BD de sua escolha.
	$con = pg_connect(getenv("DATABASE_URL"));
 
    // Obtem do BD os detalhes do produto com pid especificado na requisicao GET
    $ingr = pg_query($con, "SELECT quantidade, unidade_medida.unidade_medida AS unidade_medida, insumo.nome_insumo AS insumo
	FROM ingrediente
	INNER JOIN insumo
		ON ingrediente.FK_INSUMO_id_insumo = insumo.id_insumo
	INNER JOIN unidade_medida
		ON ingrediente.FK_UNIDADE_MEDIDA_id_unidade_medida = unidade_medida.id_unidade_medida
		WHERE fk_RECEITA_id_receita = $id_receita
		ORDER BY id_ingredientes ASC;");
		
	$passo = pg_query($con, "SELECT instrucao FROM passo_preparo
	WHERE fk_RECEITA_id_receita = $id_receita
	ORDER BY numero_sequencia ASC;");
	
 
    if (!empty($ingr)) {
        if (pg_num_rows($ingr) > 0) {
 
			// Se o produto existe, os dados de detalhe do produto 
			// sao adicionados no array de resposta.
            $ingr = pg_fetch_array($ingr);
 
            $comida = array();
            $comida["insumo"] = $ingr["insumo"];
            $comida["quantidade"] = $ingr["quantidade"];
            $comida["unidade_medida"] = $ingr["unidade_medida"];
            if (!empty($passo)) {
				if (pg_num_rows($passo) > 0) {
					$passo = pg_fetch_array($passo);
 
					$tutorial = array();
					$tutorial["instrucao"] = $ingr["instrucao"];
            // Caso o produto exista no BD, o cliente 
			// recebe a chave "success" com valor 1.
					$response["success"] = 1;
 
					$response["comida"] = $comida;
					$response["tutorial"] = $tutorial;
 
			// Converte a resposta para o formato JSON.
            array_push($response["comida"], $comida);
			array_push($response["tutoriaL"], $tutorial);
			
			// Fecha a conexao com o BD
			pg_close($con);
 
            // Converte a resposta para o formato JSON.
            echo json_encode($response);
        } else {
            // Caso o produto nao exista no BD, o cliente 
			// recebe a chave "success" com valor 0. A chave "message" indica o 
			// motivo da falha.
            $response["success"] = 0;
            $response["message"] = "Essa Receita Não Existe.";
			
			// Fecha a conexao com o BD
			pg_close($con);
 
            // Converte a resposta para o formato JSON.
            echo json_encode($response);
        }
    } else {
        // Caso o produto nao exista no BD, o cliente 
		// recebe a chave "success" com valor 0. A chave "message" indica o 
		// motivo da falha.
        $response["success"] = 0;
        $response["message"] = "Essa Receita Não Existe.";
 
		// Fecha a conexao com o BD
		pg_close($con);
 
        // Converte a resposta para o formato JSON.
        echo json_encode($response);
    }
	}else {
        // Caso o produto nao exista no BD, o cliente 
		// recebe a chave "success" com valor 0. A chave "message" indica o 
		// motivo da falha.
        $response["success"] = 0;
        $response["message"] = "Essa Receita Não Existe.";
 
		// Fecha a conexao com o BD
		pg_close($con);
 
        // Converte a resposta para o formato JSON.
        echo json_encode($response);
    }
	}else {
        // Caso o produto nao exista no BD, o cliente 
		// recebe a chave "success" com valor 0. A chave "message" indica o 
		// motivo da falha.
        $response["success"] = 0;
        $response["message"] = "Essa Receita Não Existe.";
 
		// Fecha a conexao com o BD
		pg_close($con);
 
        // Converte a resposta para o formato JSON.
        echo json_encode($response);
    }
} else {
    // Se a requisicao foi feita incorretamente, ou seja, os parametros 
	// nao foram enviados corretamente para o servidor, o cliente 
	// recebe a chave "success" com valor 0. A chave "message" indica o 
	// motivo da falha.
    $response["success"] = 0;
    $response["message"] = "Campo requerido não preenchido";
 
    // Converte a resposta para o formato JSON.
    echo json_encode($response);
}
?>