<?php


/**
Consulta o nº de processos para o I.P da sessão e retorna no formato para ser lido pelo gráfico.
*/


session_start();
$ip = $_SESSION["ip"];

$num_processes = snmpwalk($ip, "public", "1.3.6.1.2.1.25.1.6");
echo "&label=". date('H:i:s') ."&value=" . str_replace("Gauge32: ", '', $num_processes[0]);

?>
