<?php
session_start(); 
error_reporting(0);
ini_set('display_errors', 0 );
	if ( isset($_SESSION['email']) ) {
		$retorno  = array('codzero'=>0, 'email'=>$_SESSION['email']);
	} else { // se não existir a sessao
		$retorno  = array('codzero'=>'Não existe sessão', 'email'=>'usuario@aquitudotem.com');
	}
	
	$objretorno = implode('|',$retorno);
	echo $objretorno;
?>
