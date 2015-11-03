<?php


/**
Consulta o status da Memória para o I.P da sessão e retorna no formato para ser lido pelo gráfico.
Multiplica por 1024 que é o allocationUnits
*/

session_start();
$ip = $_SESSION["ip"];

$phsycal_memory_used = snmpwalk($ip, "public", "1.3.6.1.2.1.25.2.3.1.6.1");
preg_match_all('!\d+!', $phsycal_memory_used[0], $matches); //somente numeros
$var = implode(' ', $matches[0]); //copiadoarray para variavl
echo "&label=". date('H:i:s') ."&value=" . ((int) $var) * 1024

?>
