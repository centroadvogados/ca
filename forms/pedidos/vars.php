<?php
	session_start(); 
	
	function arredonda($numero) { 
		$numero = number_format($numero, 2, ',', '.'); 
		return $numero; 
	} 
	
		$chave=$_GET['chave']; //'35170520857131000288550010000846621001737240'; 
		
		$arquivo="../../xmlarqs/nfe/".$chave.".xml";
		
		if ( file_exists( $arquivo ) ) {

			// Transformando arquivo XML em Objeto
			$campos = array();
			$xml = simplexml_load_file($arquivo);
							
			foreach( $xml->NFe->infNFe->ide as $campo) {
				$ide_nNF 		= $campo->nNF;      //1
				$ide_dhEmi		= $campo->dhEmi;
				$ide_natOp     	= $campo->natOp;
			}
			
			foreach( $xml->NFe->infNFe->emit as $campo) {
				$emit_cnpj 		= $campo->CNPJ; 
				$emit_xNome		= $campo->xNome;
				$emit_xFant 	= $campo->xFant;
			}
			
			foreach( $xml->NFe->infNFe->emit->enderEmit as $campo) {
				$emit_xLgr		= $campo->xLgr;
				$emit_nro       = $campo->nro;
				$emit_xCpl      = $campo->xCpl;
				$emit_xBairro	= $campo->xBairro;	//10
				$emit_cMun		= $campo->cMun;
				$emit_xMun		= $campo->xMun;
				$emit_UF		= $campo->UF;
				$emit_CEP		= $campo->CEP;
				$emit_cPais		= $campo->cPais;
				$emit_xPais		= $campo->xPais;
				$emit_fone		= $campo->fone;
			}
			
			foreach( $xml->NFe->infNFe->emit as $campo) {
				$emit_IE		= $campo->IE;
				$emit_CRT		= $campo->CRT;
			}
			
			foreach( $xml->NFe->infNFe->dest as $campo) {
				$dest_CPF		= $campo->CPF;		//20
				$dest_xNome		= $campo->xNome;
			}	
				
			foreach( $xml->NFe->infNFe->transp->vol as $campo) {
				$tran_qVol		= $campo->qVol;		
				$tran_pesoB		= $campo->pesoB;
			}	

			$campos['zero']			= 0;
			$campos['ide_nNF'] 		= $ide_nNF; 	// 1
			$campos['ide_dhEmi']	= $ide_dhEmi;
			$campos['ide_natOp']    = $ide_natOp;
			$campos['emit_cnpj']	= $emit_cnpj ; 
			$campos['emit_xNome']	= $emit_xNome;
			$campos['emit_xFant']	= $emit_xFant;			
			$campos['emit_xLgr']	= $emit_xLgr;	
			$campos['emit_nro']		= $emit_nro;
			$campos['emit_xCpl']	= $emit_xCpl;
			$campos['emit_xBairro']	= $emit_xBairro;
			$campos['emit_cMun']	= $emit_cMun;
			$campos['emit_xMun']	= $emit_xMun;
			$campos['emit_UF']		= $emit_UF;
			$campos['emit_CEP']		= $emit_CEP;
			$campos['emit_cPais']	= $emit_cPais;
			$campos['emit_xPais']	= $emit_xPais;
			$campos['emit_fone']	= $emit_fone;
			$campos['emit_IE']		= $emit_IE;
			$campos['emit_CRT']		= $emit_CRT;
			$campos['dest_CPF']		= $dest_CPF;
			$campos['dest_xNome']	= $dest_xNome;
			
			$campos['tran_pesoB']	= $tran_pesoB;
			$campos['tran_qVol']	= $tran_qVol;
           
		} else {
			$campos['zero']		    = 1;
		}
		
		$objretorno = implode('|',$campos);
	 	
	echo ($objretorno);	
		
		
 ?>