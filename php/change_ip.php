<?php

/**
Função chamada para atribuir um endereço de I.P na sessão. Retorna dados gerais deste I.P
Chamada na "inicializaçao" do progama para um dado I.P
Ex: php/change_ip.php?ip=xxx.xxx.xxx.xxx
**/

//"104.131.187.79"
session_start();
$_SESSION["ip"]=$_GET["ip"]; //Recebe o valor do I.P da query string
$ip = $_GET["ip"];

$system_description = snmpget($ip, "public", "1.3.6.1.2.1.1.1.0"); 

$system_uptime = snmpget($ip, "public", "1.3.6.1.2.1.1.3.0"); //sysUptime
$uptime = explode(") ", $system_uptime)[1]; //pegar o formato correto

$system_location= snmpget($ip, "public", "1.3.6.1.2.1.1.6.0"); //sysLocation

$arrResult = array('sysDescr'=>str_replace("STRING: ", "", $system_description), 
	'sysUptime'=>$uptime,
	'sysLocation'=>str_replace("STRING: ", "", $system_location));

echo json_encode($arrResult); //Retorno em formato JSON

?>
