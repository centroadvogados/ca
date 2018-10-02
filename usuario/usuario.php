<?php
	session_start(); 
    
	if ( $_POST['acao']==1 ){
		if ( isset ( $_SESSION['sessiontime'] ) {
			$retorno  = array('codzero'=>0, 'email'=>$_SESSION["usua_email"]);
			$objretorno = implode('|',$retorno);
		} else	{
			$retorno  = array('codzero'=>'Dado(s) Incorreto(s)', 'email'=>'Login']);
			$objretorno = implode('|',$retorno);
		}
		
	echo $objretorno;
	} 
	
 ?>