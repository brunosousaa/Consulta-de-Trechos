<?php

include ('lib/nusoap.php');

//$cliente = new nusoap_client('http://192.168.0.201:8085/GCWSCOT.apw?WSDL', true);

//$cliente = new nusoap_client('http://189.8.3.146:8085/GCWSCOT.apw?WSDL', true);
$cliente = new nusoap_client('http://189.8.3.146:8085/GCWSCOT.apw?WSDL', 'wsdl');


$parametros = array(
	'PRMGETPRAZO' => array(
		'_CHVACESS' => '676c6f62616c636172676f2e636f6d2e62725f37333138343334325f3230313830323134',
		'CONTRIB' => '',
		'DESEST' => $_REQUEST['uf_destino'],
		'DESTINO' => $_REQUEST['cidade_destino'],
		'MODAL' => $_REQUEST['modal'],
		'ORIEST' => $_REQUEST['uf_origem'],
		'ORIGEM' => $_REQUEST['cidade_origem'],
		'PAGADOR' => '',
		'PESO' => 0,
		'VLRDANF' => 0
	)
);

$resultado = $cliente->call('PRAZOWEB', $parametros);
//print_r($resultado);



$r = simplexml_load_string($resultado['PRAZOWEBRESULT']); //Converte o array para XML.

$p = array(

	'PRAZOS' => array()

);

$i=0;



foreach($r as $k => $v)

{

	//echo $k.'='.$v.'<br>';

	$p['PRAZOS'][$i]=array(

		$k => $v

	);

	$i++;

}



echo json_encode($p);





//DEBUG
/*
echo '<br><br>';

echo 'uf_destino='.$_REQUEST['uf_destino'].'<br>';

echo 'cidade_destino='.$_REQUEST['cidade_destino'].'<br>';

echo 'uf_origem='.$_REQUEST['uf_origem'].'<br>';

echo 'cidade_origem='.$_REQUEST['cidade_origem'].'<br>';

echo 'modal='.$_REQUEST['modal'].'<br>';
*/
//END_DEBUG



/*

TESTE DIRETO NO NAVEGADOR:



    http://globalcargo.com.br/bruno/ws_totvs_obter_prazo.php?uf_destino=PA&cidade_destino=BELEM&uf_origem=SP&cidade_origem=SAO%20PAULO&modal=TD7

	

*/



?>