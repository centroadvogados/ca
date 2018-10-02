<?php 
ini_set('display_errors', 0 );
//$link = mysql_connect('sql5c75d.carrierzone.com','vwexpressc485366','pk2k3@noslimde'); 
$link = mysql_connect('localhost','root','noslimde');
if (!$link) { 
	die('Erro na conexao ao MySQL: ' . mysql_error()); 
} 
echo 'Conexao OK'; mysql_close($link); 
?> 