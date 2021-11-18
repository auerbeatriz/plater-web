<?php

/* Esses parâmetros de configuração são referentes ao ambiente de desenvolvimento local Apache-ElephantSQL 
 * Por isso, há baixa necessidade de segurança para esses parâmetros aqui, esse aquivo é para organização
 * No projeto real, dentro do Heroku, é disponibilizado uma supervariável (seila) que contém todos esses dados
 * Por isso, na implementação real, utilizaremos dentro dos arquivos de conexão a linha de código:
 * $con = pg_connect(getenv("DATABASE_URL"));
 * E isso é suficiente para acessar o banco do Heroku e ter segurança na transação (em teoria)
 * O motivo pelo qual isso não está sendo feito aqui é porque ainda estamos em fase de desenvolvimento e ficar 
 * fazendo deploys a todo o momento no Heroku demanda tempo e consome recursos limitados devido ao plano FREE
 */

 $host = "fanny.db.elephantsql.com";
 $user = "dhdwneds";
 $pass = "2ROuH9kjay7BUcsIaq1AWG7dZiddhBRz";
 $db = "dhdwneds";
?>