<?php
	/* Funcoes php do sistema */
	function Inicio() {
		if (file_exists("cfg.mobile/config.ini"))
		{
			//require_once('../../servicos.att/WSDL/publico/conexao/conexao.php');
			return true;
		} else {
			return false;
		}
	}
	
	function moeda($numero) { 
		$numero = number_format($numero, 2, ',', '.'); 
		return $numero; 
    } 

?>