<?php

/**
Consulta o status da CPU para o I.P da sessão e retorna no formato para ser lido pelo gráfico.
*/

session_start();
$ip = $_SESSION["ip"];

$cpu_used = snmpwalk($ip, "public", "1.3.6.1.2.1.25.3.3.1"); 
preg_match_all('!\d+!', $cpu_used[1], $matches); //somente numeros
$var = implode(' ', $matches[0]); //copiadoarray para variavl
echo "&label=". date('H:i:s') ."&value=" . $var

?>
