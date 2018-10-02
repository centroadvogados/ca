<?php
	session_start(); 
    
	if ( $_POST['acao']==1 ){
		if ( isset ( $_SESSION['sessiontime'] ) and $_SESSION['usu_status']==0 ) {
            		
			$direitos = array();
			$direitos['id'] 			= $_SESSION['id']; 	// 0
			$direitos['email'] 			= $_SESSION['email'];
			$direitos['senha'] 			= $_SESSION['senha'];
			$direitos['login'] 			= $_SESSION['login'];
			$direitos['nome'] 			= $_SESSION['nome'];
			$direitos['usu_nivel'] 		= $_SESSION['usu_nivel'];
			$direitos['usu_grup_id'] 	= $_SESSION['usu_grup_id'];
			$direitos['usu_status'] 	= $_SESSION['usu_status'];
			$direitos['grup_id'] 		= $_SESSION['grup_id'];
			$direitos['grup_ds'] 		= $_SESSION['grup_ds'];
			$direitos['grup_nivel'] 	= $_SESSION['grup_nivel'];
			$direitos['dt_acesso'] 		= $_SESSION['dt_acesso'];
			$direitos['sessiontime'] 	= $_SESSION['sessiontime']; 
			
			//retorna a opcao 13 do array
			if ( ($direitos['grup_nivel'] >=  $_POST['modulo']) || ( $direitos['usu_nivel'] >= $_POST['modulo'] ) ) { // Nivel do Grupo ou Usuario Nivel maior que do Grupo
					$direitos['codezero'] = 0;  			
            } else {
					$direitos['codezero'] = 1;
			}
			$objdireitos = implode('|',$direitos);				
			echo $objdireitos;				
			
		} else {
			echo 1;
		}
	} 
	
 ?>