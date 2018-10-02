<?php
error_reporting(0);
ini_set('display_errors', 0 );


$login	= 'ejoaquim@sp.gov.br';
$pswd	= 'noslimde';

$options = array(
	'location' => 'http://127.0.0.1/servicos.attpk/noWSDL/publico/appWS/wsC01.php',
	'uri' => 'http://127.0.0.1/servicos.attpk/noWSDL/publico/appWS/'
);

$client = new SoapClient(null, $options);

echo $client->mensagem('Edmilson, n&atilde;o usando WSDL') . "<br />";
echo $client->soma(3, 5) . "<br />";
echo $client->conectar($login, md5($pswd)) . "<br />";

?>