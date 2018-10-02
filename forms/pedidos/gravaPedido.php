<?php
session_start(); 

error_reporting(E_ALL);
ini_set('display_errors', 0);
	
function __autoload($classe){
	$pastas = array('../../classes/conexao');
	foreach ($pastas as $pasta)	{
		if (file_exists("{$pasta}/{$classe}.class.php"))
			{
				include_once "{$pasta}/{$classe}.class.php";
			}
	}
}

function moeda($numero) { 
    $numero = number_format($numero, 2, ',', '.'); 
    return $numero; 
} 

if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){
		$type  		= $cfg['conexao']['type'];
		$host  		= $cfg['conexao']['host'];
		$user  		= $cfg['conexao']['user'];
		$pass  		= $cfg['conexao']['pass'];
		$name  		= $cfg['conexao']['name'];
		$port  		= $cfg['conexao']['port'];
		$acronomo  	= $cfg['descricao']['nome'];
		$conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);			
}		
	
$chave		= $_GET['chave'];
$pedi_codigo= $_GET['pedi_codigo']; 
$consPedido = $conn->prepare("SELECT cp.*, p.pess_cnpj_cpf, p.pess_bairro, p.pess_nm, p.pess_apld, p.pess_end, 
									p.pess_end_nr, p.pess_compl, p.pess_cep, p.esta_ibge, p.pess_tel, 
									p.muni_ibge, p.pess_insc_rg, p.pess_tp_pessoa,
								    e.esta_uf, m.muni_nm
							FROM cada_pedidos AS cp 
							INNER JOIN cada_pessoas AS p ON p.pess_id = cp.pedi_id_cli
							INNER JOIN cada_estados AS e ON e.esta_ibge = p.esta_ibge
							INNER JOIN cada_municipios AS m ON m.muni_ibge = p.muni_ibge
							WHERE cp.pedi_chave_sefaz = :busca;	
					       "); 
								   
$consPedido->bindParam( ':busca', $chave, PDO::PARAM_STR );  
$consPedido->execute();

if ( $consPedido->rowCount()>0 ) {
   
	        foreach($consPedido as $campo){				
					$pedi_nm				= $campo["pess_nm"];
					$pedi_apld				= $campo["pess_apld"];
					$pedi_cnpj_cpf			= $campo["pess_cnpj_cpf"];
					$pedi_insc_rg			= $campo["pess_insc_rg"];
					$pedi_tel 				= $campo["pess_tel"];
					$pedi_tp_pessoa			= $campo["pess_tp_pessoa"];	
                    $pedi_end				= $campo["pess_end"];
                    $pedi_end_nr			= $campo["pess_end_nr"];
                    $pedi_compl 			= $campo["pess_compl"];		
					$pedi_bairro		    = $campo["pess_bairro"];
					$pedi_cep				= $campo["pess_cep"];
					$esta_ibge				= $campo["esta_ibge"]; 
					$muni_ibge				= $campo["muni_ibge"];
					$esta_uf				= $campo["esta_uf"];
					$muni_nm				= $campo["muni_nm"];
 					$pedi_id 				= $campo["pedi_id"];		// cada_pedido
					$pedi_id_tra			= $campo["pedi_id_tra"];
					$pedi_id_ven			= $campo["pedi_id_ven"];
					$pedi_id_cli    	   	= $campo["pedi_id_cli"];	// cada_clientes->cli_id
					$pedi_codigo       	 	= $campo["pedi_codigo"];
					$pedi_flag	 			= $campo["pedi_flag"];
					$pedi_tp				= $campo["pedi_tp"];
					$pedi_base 				= $campo["pedi_base"];
					$pedi_valoricms			= $campo["pedi_valoricms"];
					$pedi_valoripi			= $campo["pedi_valoripi"];
					$pedi_valorfrete		= $campo["pedi_valorfrete"];
					$pedi_valorseguro		= $campo["pedi_valorseguro"];
					$pedi_tnota			 	= $campo["pedi_tnota"];
					$pedi_placa 			= $campo["pedi_placa"];
					$pedi_nrvolumes			= $campo["pedi_nrvolumes"];
					$pedi_especie 			= $campo["pedi_especie"];
					$pedi_pesol 			= $campo["pedi_pesol"];
					$pedi_pesob 			= $campo["pedi_pesob"];
					$pedi_dtemissao			= $campo["pedi_dtemissao"];
                    $pedi_dtcoleta     		= $campo["pedi_dtcoleta"];
					$pedi_dtsaida 			= $campo["pedi_dtsaida"];
					$pedi_dtentrega 		= $campo["pedi_dtentrega"];
					$pedi_via	 			= $campo["pedi_via"];
					$pedi_condvenda			= $campo["pedi_condvenda"];	
					$pedi_formpag			= $campo["pedi_formpag"];	
					$pedi_nrnf				= $campo["pedi_nrnf"];
					$pedi_nfemitida			= $campo["pedi_nfemitida"];
					$pedi_desconto			= $campo["pedi_desconto"];
					$pedi_descsobre			= $campo["pedi_descsobre"];
					$pedi_confirmado		= $campo["pedi_confirmado"];
					$pedi_imp				= $campo["pedi_imp"];
					$pedi_impboleto			= $campo["pedi_impboleto"];
					$pedi_impdup			= $campo["pedi_impdup"];
					$pedi_obs1				= $campo["pedi_obs1"];
					$pedi_obs2				= $campo["pedi_obs2"];
					$pedi_marcado			= $campo["pedi_marcado"];			 
					$pedi_esta_ibge_or		= $campo["pedi_esta_ibge_or"];
					$pedi_muni_ibge_or		= $campo["pedi_muni_ibge_or"];
					$pedi_esta_ibge_dn		= $campo["pedi_esta_ibge_dn"];
					$pedi_muni_ibge_dn		= $campo["pedi_muni_ibge_dn"];
					$pedi_id_rem			= $campo["pedi_id_rem"];			// cada_remetente->reme_id		
					$pedi_id_des			= $campo["pedi_id_des"];
					$pedi_fun_id			= $campo["pedi_fun_id"];
					$pedi_tra_id			= $campo["pedi_tra_id"];
					$pedi_obs				= $campo["pedi_obs"];
					$pedi_chave_sefaz		= $campo["pedi_chave_sefaz"];
					$pedi_natOp				= $campo["pedi_natOp"];
					$pedi_codPais			= $campo["pedi_codPais"];
					$pedi_pais				= $campo["pedi_pais"];
					$pedi_CRT				= $campo["pedi_CRT"];
					
			}
				//Emissor Remetente 
				$campos['zero']			= 1;		  // 0	
				$campos['ide_nNF'] 		= $pedi_nrnf; // 1
				$campos['ide_dhEmi']	= $pedi_dtemissao;
				$campos['ide_natOp']    = $pedi_natOp;
				$campos['emit_cnpj']	= $pedi_cnpj_cpf; 
				$campos['emit_xNome']	= $pedi_nm;
				$campos['emit_xFant']	= $pedi_apld;			
				$campos['emit_xLgr']	= $pedi_end;	
				$campos['emit_nro']		= $pedi_end_nr;
				$campos['emit_xCpl']	= $pedi_compl;
				$campos['emit_xBairro']	= $pedi_bairro;
				$campos['emit_cMun']	= $muni_ibge;
				$campos['emit_xMun']	= $muni_nm;
				$campos['emit_UF']		= $esta_uf;
				$campos['emit_CEP']		= $pedi_cep;
				$campos['emit_cPais']	= $pedi_codPais;
				$campos['emit_xPais']	= $pedi_pais;
				$campos['emit_fone']	= $pedi_tel;
				$campos['emit_IE']		= $pedi_insc_rg;
				$campos['emit_CRT']		= $pedi_CRT;    // Codigo de Regime Tributario 1-Simples Nacional  2-Simples Nacional - excesso de sublimite da receita bruta  3-Regime Normal
				$campos['pedi_id_rem']	= $pedi_id_rem;
				$campos['pedi_id_des']	= $pedi_id_des; //21
			
			$dest = $conn->prepare("SELECT cp.*, p.pess_cnpj_cpf, p.pess_nm, p.pess_apld, p.pess_end, p.pess_end_nr, 
									p.pess_compl, p.pess_bairro, p.pess_cep, p.esta_ibge, p.muni_ibge, p.pess_tel, 
									p.pess_insc_rg, p.pess_tp_pessoa,
									e.esta_uf, m.muni_nm
							FROM cada_pedidos AS cp 
							INNER JOIN cada_pessoas AS p ON p.pess_id = cp.pedi_id_des
							INNER JOIN cada_estados AS e ON e.esta_ibge = p.esta_ibge
							INNER JOIN cada_municipios AS m ON m.muni_ibge = p.muni_ibge
							WHERE cp.pedi_id = :busca;		
									   "); 
								   
			$dest->bindParam( ':busca', $pedi_id, PDO::PARAM_STR );  
			$dest->execute();
			if ( $dest->rowCount()>0 ) {
					foreach($dest as $campo){
						$dest_pess_cnpj_cpf	= $campo["pess_cnpj_cpf"];
						$dest_pess_nm 	 	= $campo["pess_nm"];
						$dest_pess_apld		= $campo["pess_apld"];
						$dest_pess_end	 	= $campo["pess_end"];
						$dest_pess_end_nr	= $campo["pess_end_nr"];
						$dest_pess_compl 	= $campo["pess_compl"];
						$dest_pess_bairro	= $campo["pess_bairro"];
						$dest_pess_cep   	= $campo["pess_cep"];
						$dest_pess_esta_ibge= $campo["esta_ibge"];
						$dest_pess_muni_ibge= $campo["muni_ibge"];
						$dest_esta_uf       = $campo["esta_uf"];
						$dest_muni_nm       = $campo["muni_nm"];
						$dest_pedi_codPais  = $campo["pedi_codPais"];
						$dest_pedi_pais     = $campo["pedi_pais"];
						$dest_pess_tel		= $campo["pess_tel"];
						$dest_pess_insc_rg  = $campo["pess_insc_rg"];
					}	
						
				$campos['dest_cnpj']	= $dest_pess_cnpj_cpf; //22
				$campos['dest_xNome']	= $dest_pess_nm;
				$campos['dest_xFant']	= $dest_pess_apld;			
				$campos['dest_xLgr']	= $dest_pess_end;	
				$campos['dest_nro']		= $dest_pess_end_nr;
				$campos['dest_xCpl']	= $dest_pess_compl;
				$campos['dest_xBairro']	= $dest_pess_bairro;
				$campos['dest_CEP']		= $dest_pess_cep;
				$campos['dest_cMun']	= $dest_pess_muni_ibge;
				$campos['dest_xMun']	= $dest_muni_nm;
				$campos['dest_UF']		= $dest_esta_uf;
				$campos['dest_cPais']	= $dest_pedi_codPais;
				$campos['dest_xPais']	= $dest_pedi_pais;
				$campos['dest_fone']	= $dest_pess_tel;
				$campos['dest_IE']		= $dest_pess_insc_rg; //36
									
			}
			
				$campos['pedi_pesob']	= $pedi_pesob;		  //37	
				$campos['pedi_qVol']	= $pedi_nrvolumes;
				$campos['pedi_tra_id']	= $pedi_tra_id;		  
				$campos["pedi_ven_id"]	= $pedi_id_ven;
				$campos["pedi_codigo"]  = $pedi_codigo;
				$campos["pedi_flag"]  	= $pedi_flag;
				$campos["pedi_tp"]		= $pedi_tp;
				$campos["pedi_base"]	= $pedi_base;
				$campos["pedi_valoricms"]	= $pedi_valoricms;
				$campos["pedi_valoripi"]	= $pedi_valoripi;
				$campos["pedi_valorfrete"]	= $pedi_valorfrete;
				$campos["pedi_valorseguro"]	= $pedi_valorseguro;
				$campos["pedi_tnota"]		= $pedi_tnota;	
				$campos["pedi_placa"]		= $pedi_placa;    //50
				$campos["pedi_especie"]		= $pedi_especie;
				$campos['pedi_pesol']		= $pedi_pesol;
				$campos['pedi_dtcoleta']	= $pedi_dtcoleta;
				$campos['pedi_dtsaida']		= $pedi_dtsaida;
				$campos['pedi_dtentrega']	= $pedi_dtentrega;
				$campos['pedi_via']			= $pedi_via;
				
				$campos['pedi_condvenda']	= $pedi_condvenda;
				$campos['pedi_formpag']		= $pedi_formpag;
				$campos['pedi_nfemitida']	= $pedi_nfemitida;
				$campos['pedi_desconto']	= $pedi_desconto; //60
				$campos['pedi_descsobre']	= $pedi_descsobre;
				$campos['pedi_confirmado']	= $pedi_confirmado;
				$campos['pedi_imp']			= $pedi_imp;
				$campos['pedi_impboleto']	= $pedi_impboleto;
				
				$campos['pedi_impdup']		= $pedi_impdup;  //65
				$campos['pedi_obs1']		= $pedi_obs1;
				$campos['pedi_obs2']		= $pedi_obs2;
				$campos['pedi_marcado']		= $pedi_marcado;
				$campos['pedi_esta_ibge_or']= $pedi_esta_ibge_or;
				$campos['pedi_muni_ibge_or']= $pedi_muni_ibge_or;//70
				$campos['pedi_esta_ibge_dn']= $pedi_esta_ibge_dn;
				$campos['pedi_muni_ibge_dn']= $pedi_muni_ibge_dn;
				$campos['pedi_id_rem']		= $pedi_id_rem;
				$campos['pedi_id_des']		= $pedi_id_des;
				$campos['pedi_fun_id']		= $pedi_fun_id;
				$campos['pedi_tra_id']		= $pedi_tra_id;
				$campos['pedi_obs']			= $pedi_obs;
				$campos['pedi_chave_sefaz']	= $pedi_chave_sefaz;
				$campos['pedi_natOp']		= $pedi_natOp;
				$campos['pedi_codPais']		= $pedi_codPais;   //80
				$campos['pedi_pais']		= $pedi_pais;
				$campos['pedi_CRT']			= $pedi_CRT;       //82
				
} else {	// Pedido nao Encontrado na Base de Dados
		$arquivo="../../xmlarqs/nfe/".$chave.".xml";
		
		if ( file_exists( $arquivo ) ) {

			// Transformando arquivo XML em Objeto
			$campos = array();
			$xml = simplexml_load_file($arquivo);
			$campos['zero']			= 0;		  //0
			
			foreach( $xml->NFe->infNFe->ide as $campo) {
				$ide_nNF 		= $campo->nNF;      //1
				$ide_dhEmi		= $campo->dhEmi;
				$ide_natOp     	= $campo->natOp;
				$ide_cNF     	= $campo->cNF;		
				$ide_UF			= $campo->cUF;
				$ide_indPag		= $campo->indPag;      
				$ide_mod		= $campo->mod;
				$ide_serie     	= $campo->serie;
				$ide_tpNF     	= $campo->tpNF;
				$ide_idDest    	= $campo->idDest;
				$ide_cMunFG    	= $campo->cMunFG;
				$ide_tpImp     	= $campo->tpImp;
				$ide_tpEmis    	= $campo->tpEmis;
				$ide_cDV     	= $campo->cDV;
				$ide_tpAmb     	= $campo->tpAmb;
				$ide_indFinal   = $campo->indFinal;
				$ide_indPres   	= $campo->indPres;
				$ide_procEmi   	= $campo->procEmi;
				$ide_verProc   	= $campo->verProc;//19				
			}   //------------- Inicio Objeto ------------------
			    $campos['emit_nNF']		= $ide_nNF;  //1
				$campos['emit_dhEmi']	= $ide_dhEmi;
				$campos['ide_natOp']    = $ide_natOp;
				$campos['ide_cNF']		= $ide_cNF;		
				$campos['ide_UF'] 		= $ide_UF;
				$campos['ide_indPag'] 	= $ide_indPag;
				$campos['ide_mod'] 		= $ide_mod;
				$campos['ide_serie'] 	= $ide_serie;
				$campos['ide_tpNF'] 	= $ide_tpNF;
				$campos['ide_idDest'] 	= $ide_idDest; 
				$campos['ide_cMunFG'] 	= $ide_cMunFG;
				$campos['ide_tpImp'] 	= $ide_tpImp;
				$campos['ide_tpEmis'] 	= $ide_tpEmis;
				$campos['ide_cDV'] 		= $ide_cDV;
				$campos['ide_tpAmb'] 	= $ide_tpAmb;
				$campos['ide_indFinal'] = $ide_indFinal;
				$campos['ide_indPres'] 	= $ide_indPres;
				$campos['ide_procEmi'] 	= $ide_procEmi;
				$campos['ide_verProc'] 	= $ide_verProc;//19
				
			foreach( $xml->NFe->infNFe->emit as $campo) {
				$emit_cnpj 		= $campo->CNPJ;           //1
				$emit_xNome		= $campo->xNome;
				$emit_xFant 	= $campo->xFant;
				$emit_xLgr		= $campo->enderEmit->xLgr;
				$emit_nro       = $campo->enderEmit->nro;
				$emit_xCpl      = $campo->enderEmit->xCpl;
				$emit_xBairro	= $campo->enderEmit->xBairro;	
				$emit_cMun		= $campo->enderEmit->cMun;
				$emit_xMun		= $campo->enderEmit->xMun;
				$emit_UF		= $campo->enderEmit->UF;
				$emit_CEP		= $campo->enderEmit->CEP;
				$emit_cPais		= $campo->enderEmit->cPais;
				$emit_xPais		= $campo->enderEmit->xPais;
				$emit_fone		= $campo->enderEmit->fone;
				$emit_IE		= $campo->IE;
				$emit_CRT		= $campo->CRT;				//16
			}   //------------- continuacao Objeto ------------------
				$campos['emit_cnpj']	= $emit_cnpj ; //20
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
				$campos['emit_CRT']		= $emit_CRT;  //35

			foreach( $xml->NFe->infNFe->dest as $campo) {
				if( isset($campo->CPF) ) { // campo destino
					$dest_CNPJ_CPF	= $campo->CPF;		    
				} elseif($campo->CNPJ) {
					$dest_CNPJ_CPF	= $campo->CNPJ;
				}
				$dest_xNome		= $campo->xNome;
				$dest_indIEDest	= $campo->indIEDest;
				$dest_xLgr		= $campo->enderDest->xLgr;
				$dest_nro       = $campo->enderDest->nro;
				$dest_xCpl      = $campo->enderDest->xCpl;
				$dest_xBairro	= $campo->enderDest->xBairro;	
				$dest_cMun		= $campo->enderDest->cMun;
				$dest_xMun		= $campo->enderDest->xMun;
				$dest_UF		= $campo->enderDest->UF;
				$dest_CEP		= $campo->enderDest->CEP;
				$dest_cPais		= $campo->enderDest->cPais;
				$dest_xPais		= $campo->enderDest->xPais;
				$dest_fone		= $campo->enderDest->fone;//14
			}   //------------- continuacao Objeto ------------------
				$campos['dest_CNPJ_CPF']= $dest_CNPJ_CPF;   //36
				$campos['dest_xNome']	= $dest_xNome;
				$campos['dest_indIEDest']= $dest_indIEDest;
				$campos['dest_xLgr']	= $dest_xLgr;  	
				$campos['dest_nro']		= $dest_nro;
				$campos['dest_xCpl']	= $dest_xCpl;
				$campos['dest_xBairro']	= $dest_xBairro;
				$campos['dest_cMun']	= $dest_cMun;
				$campos['dest_xMun']	= $dest_xMun;
				$campos['dest_UF']		= $dest_UF;
				$campos['dest_CEP']		= $dest_CEP;
				$campos['dest_cPais']	= $dest_cPais; 
				$campos['dest_xPais']	= $dest_xPais;
				$campos['dest_fone']	= $dest_fone;   //49
					
			foreach( $xml->NFe->infNFe->total->ICMSTot as $campo) {
				$icms_vBC		= $campo->vBC;		//1		
				$icms_vICMS		= $campo->vICMS;
				$icms_vICMDeson	= $campo->vICMDeson;
				$icms_vBCST		= $campo->vBCST;
				$icms_vST		= $campo->vST;
				$icms_vProd		= $campo->vProd;
				$icms_vFrete	= $campo->vFrete;
				$icms_vSeg		= $campo->vSeg;
				$icms_vDesc		= $campo->vDesc;
				$icms_vII		= $campo->vII;
				$icms_vIPI		= $campo->vIPI;
				$icms_vPIS		= $campo->vPIS;
				$icms_vCOFINS	= $campo->vCOFINS;
				$icms_vOutro	= $campo->vOutro;
				$icms_vNF		= $campo->vNF;
				$icms_vTotTrib	= $campo->vTotTrib;  //16
			}	//------------- continuacao Objeto ------------------			
				$campos['icms_vBC']		= $icms_vBC;   //50	
				$campos['icms_vICMS']	= $icms_vICMS;
				$campos['icms_vICMDeson']=$icms_vICMDeson;
				$campos['icms_vBCST']	= $icms_vBCST;
				$campos['icms_vST']		= $icms_vST;
				$campos['icms_vProd']	= $icms_vProd;
				$campos['icms_vFrete']	= $icms_vFrete; 
				$campos['icms_vSeg']	= $icms_vSeg;
				$campos['icms_vDesc']	= $icms_vDesc;
				$campos['icms_vII']		= $icms_vII;
				$campos['icms_vIPI']	= $icms_vIPI;
				$campos['icms_vPIS']	= $icms_vPIS;
				$campos['icms_vCOFINS']	= $icms_vCOFINS;
				$campos['icms_vOutro']	= $icms_vOutro;
				$campos['icms_vNF']		= $icms_vNF;
				$campos['icms_vTotTrib']= $icms_vTotTrib;//65
			
				
			foreach( $xml->NFe->infNFe->transp as $campo) {
		
				$tran_modFrete	= $campo->modFrete;	     //1	
				$tran_CNPJ		= $campo->transporta->CNPJ;
				$tran_xNome		= $campo->transporta->xNome;
				$tran_IE		= $campo->transporta->IE;
				$tran_xEnder	= $campo->transporta->xEnder;
				$tran_xMun		= $campo->transporta->xMun;
				$tran_UF		= $campo->transporta->UF;		
				$tran_qVol		= $campo->vol->qVol;	
				$tran_esp		= $campo->vol->esp;
				$tran_nVol		= $campo->vol->nVol;				
				$tran_pesoB		= $campo->vol->pesoB;
				$tran_pesoL		= $campo->vol->pesoL;		//12			
			}	//------------- continuacao Objeto ------------------
			    $campos['tran_modFrete']= $tran_modFrete;	 //66
				$campos['tran_CNPJ']	= $tran_CNPJ;
				$campos['tran_xNome']	= $tran_xNome;			
	            $campos['tran_IE']		= $tran_IE;			
	            $campos['tran_xEnder']	= $tran_xEnder;			
	            $campos['tran_xMun']	= $tran_xMun;			
	            $campos['tran_UF']		= $tran_UF;
				$campos['tran_qVol']	= $tran_qVol;		
                $campos['tran_esp']		= $tran_esp;
                $campos['tran_nVol']	= $tran_nVol;				
				$campos['tran_pesoB']	= $tran_pesoB; 
				$campos['tran_pesoL']	= $tran_pesoL;	 //77
				
			foreach( $xml->NFe->infNFe->cobr as $campo) {
				$cobr_nFat		= $campo->fat->nFat;	//1		
				$cobr_vOrig		= $campo->fat->vOrig;
				$cobr_vLiq		= $campo->fat->vLiq;
				$cobr_nDup		= $campo->dup->nDup;		
				$cobr_dVenc		= $campo->dup->dVenc;
				$cobr_vDup		= $campo->dup->vDup;	//6
			}  //------------- continuacao Objeto ------------------				
                $campos['cobr_nFat']	= $cobr_nFat;    //78 
                $campos['cobr_vOrig']	= $cobr_vOrig; 
                $campos['cobr_vLiq']	= $cobr_vLiq; 
                $campos['cobr_nDup']	= $cobr_nDup;  
                $campos['cobr_dVenc']	= $cobr_dVenc; 
                $campos['cobr_vDup']	= $cobr_vDup;    //83
		
				$campos['pedi_codigo']	= $pedi_codigo; 
				$campos['pedi_chsefaz']	= $chave;        //85
			
		} else {
			
				$campos['zero']		    = 2; // arquivo XML nao existe
		}
		
		$objretorno = implode('|',$campos);
}

echo ($objretorno);	
 ?>