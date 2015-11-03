<?php


/**
Consulta o status do tráfego da rede para o I.P da sessão e retorna no formato para ser lido pelo gráfico.
Como a informação de in e out são do tipo COunter32 preciso comparar os resultados com coleta anterior.
*/


ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

session_start();
$ip = $_SESSION["ip"];

//Capturar dados atuais da placa de rede
$in_network = snmpwalk($ip, "public", "1.3.6.1.2.1.2.2.1.10.2"); //interface de rede sempre fixa
$in_network_int = (int) str_replace("Counter32: ", "", $in_network[0]);

$out_network = snmpwalk($ip, "public", "1.3.6.1.2.1.2.2.1.16.2"); //interface de rede sempre fixa
$out_network_int = (int) str_replace("Counter32: ", "", $out_network[0]);

/*
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
*/

//Se ja teve uma captura anterior
if(isset($_SESSION['last_check']) && !empty($_SESSION['last_check'])) {

	//Capturar variaveis da sessão de captura anterior
	$last_in_network = $_SESSION["last_in"];
	$last_out_network = $_SESSION["last_out"];
	$last_check_network = $_SESSION["last_check"];
	
	$data_sessao = new DateTime($last_check_network);
	$agora = new DateTime();	
	$duration=$agora->diff($data_sessao); //intervalo entre checagens
	$duration_seconds=(int) ($duration->format('%s'));

	$in_per_second = ($in_network_int-$last_in_network)/$duration_seconds; // (trafego atual - ultima captura) / intervalo
	$out_per_second = ($out_network_int-$last_out_network)/$duration_seconds;
	//valores in e out estão em octetos (8 bytes) / 1024 => retorna valores em kb/s
	echo "&label=". date('H:i:s') ."&value=" . ($in_per_second/1024) . "|" . ($out_per_second/1024);

} else {
	echo "&label=". date('H:i:s') ."&value=0|0";
}

//Atualizar dados da sessão
$_SESSION["last_check"] = date('d/m/Y H:i:s'); //Salvar na sessão momento de ultima captura
$_SESSION["last_in"] = $in_network_int;
$_SESSION["last_out"] = $out_network_int;

?>
