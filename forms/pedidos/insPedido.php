<?php
session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$modulo	=	$_POST['modulo'];
//$dados	='0|00010186|2017-05-16|VENDA MERC. ADQ. OU RECEBIDA DE TERCEIROS|05.259.711/0001-07|Platex Processos Plasticos Ltda|Platex Fantasia|rua Bernardo Svartman,400|400|complemento|Centro|3550308|SAO PAULO|SP|06900-000|1058|Brasil|1146618038|isento|3|173|174|19316407000150|GOLD PRODUTOS PARA FESTAS LTDA ME|GOLD PRODUTOS|AVENIDA ANAPOLIS QD1 LT 29E/31|855|complemento|RESIDENCIAL SONHO DOURADO|74781005|5208707|GOIANIA|GO|1058|Brasil|1234567666|105851833|177.50|50|FECHAMENTO';
$data     =   explode("-",date('d-m-Y'));
$hora     =   explode(":",date('H:i:s'));
if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) )
{
		$type  		= $cfg['conexao']['type'];
		$host  		= $cfg['conexao']['host'];
		$user  		= $cfg['conexao']['user'];
		$pass  		= $cfg['conexao']['pass'];
		$name  		= $cfg['conexao']['name'];
		$port  		= $cfg['conexao']['port'];
		$acronomo  	= $cfg['descricao']['nome'];
		
		$conn  	= new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);	
		
		$campos = explode("|", $_POST['dados']);
	        
				$campo_zero		= $campos[0];
				$ide_nNF 		= $campos[1];
				$ide_dhEmi		= $campos[2];
				$ide_natOp     	= substr($campos[3],0,59);
				$ide_cNF     	= $campos[4];		
				$ide_cUF		= $campos[5];
				$ide_indPag		= $campos[6];      
				$ide_mod		= $campos[7];
				$ide_serie     	= $campos[8];
				$ide_tpNF     	= $campos[9];
				$ide_idDest    	= $campos[10];
				$ide_cMunFG    	= $campos[11];
				$ide_tpImp     	= $campos[12];
				$ide_tpEmis    	= $campos[13];
				$ide_cDV     	= $campos[14];
				$ide_tpAmb     	= $campos[15];
				$ide_indFinal   = $campos[16];
				$ide_indPres   	= $campos[17];
				$ide_procEmi   	= $campos[18];
				$ide_verProc   	= $campos[19];					
				
				$emit_cnpj 		= $campos[20];	           
				$emit_xNome		= substr($campos[21],0,29); $pess_nm 	= substr($campos[21],0,79);
				$emit_xFant 	= substr($campos[22],0,19);
				$emit_xLgr		= substr($campos[23],0,44);
				$emit_nro       = $campos[24];
				$emit_xCpl      = substr($campos[25],0,29);
				$emit_xBairro	= substr($campos[26],0,29);
				$emit_cMun		= $campos[27];
				$emit_xMun		= $campos[28];
				$emit_UF		= $campos[29];
				$emit_CEP		= $campos[30];
				$emit_cPais		= $campos[31];
				$emit_xPais		= $campos[32];
				$emit_fone		= $campos[33]; $pess_fone	= 0;
				$emit_IE		= $campos[34];
				$emit_CRT		= $campos[35];

				$dest_CPF		= $campos[36];
				$dest_xNome		= substr($campos[37],0,79);
				$dest_xFant 	= substr($campos[37],0,19);
				$dest_indIEDest	= $campos[38];
				$dest_xLgr		= substr($campos[39],0,44);
				$dest_nro       = $campos[40];
				$dest_xCpl      = $campos[41];
				$dest_xBairro	= substr($campos[42],0,29);
				$dest_cMun		= $campos[43];
				$dest_xMun		= $campos[44];
				$dest_UF		= $campos[45];
				$dest_CEP		= $campos[46];
				$dest_cPais		= $campos[47];
				$dest_xPais		= $campos[48];
				$dest_fone		= $campos[49];
				
				$icms_vBC		= $campos[50];
				$icms_vICMS		= $campos[51];
				$icms_vICMDeson	= $campos[52];
				$icms_vBCST		= $campos[53];
				$icms_vST		= $campos[54];
				$icms_vProd		= $campos[55];
				$icms_vFrete	= $campos[56];
				$icms_vSeg		= $campos[57];
				$icms_vDesc		= $campos[58];
				$icms_vII		= $campos[59];
				$icms_vIPI		= $campos[60];
				$icms_vPIS		= $campos[61];
				$icms_vCOFINS	= $campos[62];
				$icms_vOutro	= $campos[63];
				$icms_vNF		= $campos[64];
				$icms_vTotTrib	= $campos[65];

				$tran_modFrete	= $campos[66];	
				$tran_CNPJ		= $campos[67];
				$tran_xNome		= $campos[68];
				$tran_IE		= $campos[69];
				$tran_xEnder	= $campos[70];
				$tran_xMun		= $campos[71];
				$tran_UF		= $campos[72];
				$tran_qVol		= $campos[73];
				$tran_esp		= $campos[74];
				$tran_nVol		= $campos[75];
				$tran_pesoB		= $campos[76];
				$tran_pesoL		= $campos[77];
				
				$cobr_nFat		= $campos[78];
				$cobr_vOrig		= $campos[79];
				$cobr_vLiq		= $campos[80];
				$cobr_nDup		= $campos[81];
				$cobr_dVenc		= $campos[82];
				$cobr_vDup		= $campos[83];
				
				$pedi_codigo	= $campos[84];
				$pedi_chsefaz	= $campos[85];
				
                $pedi_id_tra		=1;
				$pedi_id_ven		=1;
				$pedi_flag			=0;	
				$pedi_placa			='';
				$pedi_dtemissao		= date('Y-m-d h:i:s');
				$pedi_dtcoleta		='';
				$pedi_dtsaida		='';
				$pedi_dtentrega		='';
				$pedi_condvenda		='';
				$pedi_formpag		='';
				$pedi_nfemitida		=0;
				$pedi_descsobre		=0;
				$pedi_confirmado	=1;
				$pedi_imp			=0;
				$pedi_impdup		=0;
				$pedi_obs1			='';
				$pedi_obs2			='';
				$pedi_marcado		=0;
				$pedi_id_rem		=0;
				$pedi_id_des		=0;
				$pedi_fun_id		=0;
				$pedi_obs			='';
				$emit_esta_ibge		=0;
                $pess_email			='usuario@empresa.com.br';		
				if ( strlen($emit_cnpj)>=14 ) { $pess_tp_pessoa	='J'; } 
				elseif ( strlen($emit_cnpj)<=11){ $pess_tp_pessoa	='F'; }
				$pess_delete		='FALSE';
				$pess_tel			=0;
				$pess_dt_inc		=date('Y-m-d');
				$pess_cli			='TRUE';

				$clie_dt_ul_compra	=date('Y-m-d h:i:s');
				$clie_vl_ul_compra	=$icms_vBC;
				
				$dest_vl_limite_cred=0;
				$dest_obs			='';
				$dest_publicidade   ='N';
				$pess_dest_cUF		=0;
                
				$campos[0] = 1;
	try
    {	
		//-------------------------------------------------------------------------------------
		$consEstado = $conn->prepare("SELECT esta_ibge, esta_uf, esta_nm
										FROM cada_estados											
										WHERE esta_uf = :p_esta_uf");
		$consEstado->bindParam( ':p_esta_uf', $dest_UF );						   
		$consEstado->execute();
		$consEstado->closeCursor();
		if ( $consEstado->execute() ){
			foreach($consEstado as $row){				
				$pess_dest_cUF	=$row["esta_ibge"];
			}			
		}
		//--------------------------------Consulta Pessoa Emissor------------------------------			
		$consPessoaEmit = $conn->prepare("SELECT pess_id, pess_cnpj_cpf
										  FROM cada_pessoas											
										  WHERE pess_cnpj_cpf = :p_pess_cnpj
										 ");
		$consPessoaEmit->bindParam(':p_pess_cnpj', $emit_cnpj);						   
		$consPessoaEmit->execute();
		if( $consPessoaEmit->rowCount() )
		{   
			foreach($consPessoaEmit as $row){				
				$campos[86]	= $row["pess_id"];
			}
			$consCliente = $conn->prepare("SELECT clie_id FROM cada_clientes WHERE clie_id = :p_clie_id");
			$consCliente->bindParam(':p_clie_id' , $campos[86]);
			$consCliente->execute();
			if( $consCliente->rowCount()>0 ){
				$consRemetente = $conn->prepare("SELECT reme_id FROM cada_remetente WHERE reme_id = :p_reme_id");
				$consRemetente->bindParam(':p_reme_id' , $campos[86]);
				$consRemetente->execute();
				if( $consRemetente->rowCount()>0 ){
					//--------------------------Pessoa Destinatario---------------------------
					$consPessDest 	= 	$conn->prepare("SELECT pess_id, pess_cnpj_cpf
														FROM cada_pessoas											
														WHERE pess_cnpj_cpf = :p_pess_cnpj_dest");
					$consPessDest->bindParam(':p_pess_cnpj_dest' , $campos[36]);
					$consPessDest->execute();							
					if( $consPessDest->rowCount()>0 )
					{
						foreach($consPessDest as $row){				
							$campos[87]	= $row["pess_id"];
						}	
						$consDestinatario = $conn->prepare("SELECT dest_id																FROM cada_pessoas											
														    WHERE dest_id = :p_dest_id");
						$consDestinatario->bindParam(':p_dest_id', $campos[87]);						   
						$consDestinatario->execute();
						$consDestinatario->closeCursor();
						if ( $consDestinatario->rowCount()>0 ) {
										
						} else {
							$sqldest="INSERT INTO cada_destinatario ( dest_id ) 
									  VALUES ( :p_dest_id )";
							$insRemetente = $conn->prepare( $sqldest );
							$insRemetente->bindParam(':p_dest_id' ,$campos[87] );
							$insRemetente->execute();
							$insRemetente->closeCursor();	
						}								
						$campos[0]  = 0;	
					} 
					else 
					{
						
								$sqlPessoaDestino="INSERT INTO cada_pessoas ( 
											pess_nm, pess_apld, pess_end, pess_end_nr, pess_bairro, 
											muni_ibge, pess_cep, pess_fone, pess_cnpj_cpf, 
											pess_dt_aber_nasc, pess_tp_pessoa, esta_ibge
								) VALUES (
											:pess_nm, :pess_apld, :pess_end, :pess_end_nr, :pess_bairro, 
											:pess_muni_ibge, :pess_cep, :pess_fone, :pess_cnpj_cpf,	
											:pess_dt_aber_nasc, :pess_tp_pessoa, :pess_esta_ibge 
								)";
								$insPessDestino = $conn->prepare( $sqlPessoaDestino );
											
								$insPessDestino->bindParam(':pess_nm'	 		, $dest_xNome);
								$insPessDestino->bindParam(':pess_apld'  		, $dest_xFant);
								$insPessDestino->bindParam(':pess_end'	 		, $dest_xLgr );	
								$insPessDestino->bindParam(':pess_end_nr'		, $dest_nro  );
								$insPessDestino->bindParam(':pess_bairro'		, $dest_xBairro);
								$insPessDestino->bindValue(':pess_muni_ibge'	, $dest_cMun );
								$insPessDestino->bindParam(':pess_cep'	 		, $dest_CEP  );
								$insPessDestino->bindParam(':pess_fone'	 		, $dest_fone );
								$insPessDestino->bindParam(':pess_cnpj_cpf'		, $campos[36]);			
								$insPessDestino->bindParam(':pess_dt_aber_nasc'	, $pedi_dtemissao);			
								$insPessDestino->bindParam(':pess_tp_pessoa'	, $pess_tp_pessoa);
								$insPessDestino->bindValue(':pess_esta_ibge'	, $pess_dest_cUF );
										
								if ( $insPessDestino->execute() ){
									$insPessDestino->closeCursor();								
									$campos[87] = $conn->lastInsertId();
									$sqldest="INSERT INTO cada_destinatario ( dest_id ) 
											  VALUES ( :p_dest_id )";
									$insDestinatario = $conn->prepare( $sqldest );
									$insDestinatario->bindParam(':p_dest_id' , $campos[87] );
									$insDestinatario->execute();
									$insDestinatario->closeCursor();
									$campos[0]  = 0;
								} else {
									$campos[0]  = 1;
									$campos[87] = 'Falha Insercao Pessoa Destino';
								}
					}
				} 
				else 
				{
									$sqldest="INSERT INTO cada_remetente ( reme_id ) 
											  VALUES ( :p_reme_id )";
									$insDestinatario = $conn->prepare( $sqldest );
									$insDestinatario->bindParam(':p_reme_id' , $campos[86] );
									$insDestinatario->execute();
									$insDestinatario->closeCursor();
									$campos[0]  = 0;					
				}
			} else {
				$campos[0]  = 1;
				$campos[87] = 'Falha Verificacao Cliente';
			}	 
		} 
		else 
		{	
			$pessoa="INSERT INTO cada_pessoas ( 
					 pess_nm, pess_apld,pess_end, pess_end_nr, pess_compl, pess_bairro, pess_cep, 
					 pess_fone, pess_cnpj_cpf, pess_insc_rg,	pess_dt_aber_nasc, pess_tp_pessoa,
					 esta_ibge, muni_ibge, pess_cli
			) VALUES (
					 :pess_nm, :pess_apld, :pess_end, :pess_end_nr, :pess_compl, :pess_bairro, :pess_cep, 
					 :pess_fone, :pess_cnpj_cpf, :pess_insc_rg, :pess_dt_aber_nasc, :pess_tp_pessoa, 
					 :pess_esta_ibge, :pess_muni_ibge, :pess_cli )";			
			$insPessoaReme = $conn->prepare( $pessoa );
			$insPessoaReme->bindParam(':pess_nm'	      , $pess_nm   );
			$insPessoaReme->bindParam(':pess_apld'     	  , $emit_xFant);
			$insPessoaReme->bindParam(':pess_end'		  , $emit_xLgr );	
			$insPessoaReme->bindParam(':pess_end_nr'	  , $emit_nro  );
			$insPessoaReme->bindParam(':pess_compl'		  , $emit_xCpl );			
			$insPessoaReme->bindParam(':pess_bairro'	  , $emit_xBairro);
			$insPessoaReme->bindParam(':pess_cep'		  , $emit_CEP  );
			$insPessoaReme->bindParam(':pess_fone'		  , $emit_fone );
			$insPessoaReme->bindParam(':pess_cnpj_cpf'	  , $emit_cnpj );			
			$insPessoaReme->bindParam(':pess_insc_rg'	  , $emit_IE   ); 
			$insPessoaReme->bindParam(':pess_dt_aber_nasc', $pedi_dtemissao);			
			$insPessoaReme->bindParam(':pess_tp_pessoa'	  , $pess_tp_pessoa );
			$insPessoaReme->bindValue(':pess_esta_ibge'   , $ide_cUF );
			$insPessoaReme->bindValue(':pess_muni_ibge'	  , $emit_cMun );
			$insPessoaReme->bindValue(':pess_cli'		  , $pess_cli  );
			if ( $insPessoaReme->execute() )
			{
				$insPessoaReme->closeCursor();
				$campos[86]	= $conn->lastInsertId(); //---------------id Pessoa Cliente Remetente	
				$cliente="INSERT INTO cada_clientes ( clie_id, clie_dt_ul_compra, clie_vl_ul_compra, pedi_codigo
				          ) VALUES ( :clie_id, :clie_dt_ul_compra, :clie_vl_ul_compra, :pedi_codigo )";
				$insCliente = $conn->prepare( $cliente );
				$insCliente->bindParam(':clie_id'	 	   ,$campos[86]);
				$insCliente->bindParam(':clie_dt_ul_compra', $clie_dt_ul_compra);
				$insCliente->bindValue(':clie_vl_ul_compra', $clie_vl_ul_compra);
				$insCliente->bindParam(':pedi_codigo'      , $pedi_codigo); 
				if ( $insCliente->execute() )
				{
					$insCliente->closeCursor();
					//---------------------------Remetente-----------------------------
					$sqlreme="INSERT INTO cada_remetente ( reme_id ) 
					    	  VALUES ( :p_reme_id )";
					$insRemetente = $conn->prepare( $sqlreme );
					$insRemetente->bindParam(':p_reme_id' ,$campos[86] );
					$insRemetente->execute();
					$insRemetente->closeCursor();
					//---------------------------Destinatario--------------------------                    
					if ( strlen($campos[36])>=14 ) { $pess_tp_pessoa	='J'; } 
					elseif ( strlen($campos[36])<=11) { $pess_tp_pessoa ='F'; }
					$consPessDest = $conn->prepare("SELECT pess_id, pess_cnpj_cpf
												    FROM cada_pessoas											
												    WHERE pess_cnpj_cpf = :p_pess_cnpj");
					$consPessDest->bindParam(':p_pess_cnpj', $campos[36]);						   
					$consPessDest->execute();
					//$consPessDest->closeCursor();
						if ( $consPessDest->rowCount()>0 ) 
						{
							foreach($consPessDest as $row){	
								$campos[87]	= $row["pess_id"];	
								$CNPJPessoa	= $row["pess_cnpj_cpf"];
							}
							$consDestinatario = $conn->prepare("SELECT dest_id
																FROM cada_destinatario											
																WHERE dest_id = :p_dest_id");
							$consDestinatario->bindParam(':p_dest_id', $campos[87]);						   
							$consDestinatario->execute();
							//$consDestinatario->closeCursor();
							if ( $consDestinatario->rowCount()>0 ) {
				                			
							} else {
								$sqldest="INSERT INTO cada_destinatario ( dest_id ) 
										  VALUES ( :p_dest_id )";
								$insDestinatario = $conn->prepare( $sqldest );
								$insDestinatario->bindParam(':p_dest_id' ,$campos[87] );
								$insDestinatario->execute();
								$insDestinatario->closeCursor();
							}
						  $campos[0]	= 0;
					    } 
						else 
						{
							$sqlPessoaDestino="INSERT INTO cada_pessoas ( 
										pess_nm, pess_apld, pess_end, pess_end_nr, pess_bairro, 
										muni_ibge, pess_cep, pess_fone, pess_cnpj_cpf, 
										pess_dt_aber_nasc, pess_tp_pessoa, esta_ibge
							) VALUES (
										:pess_nm, :pess_apld, :pess_end, :pess_end_nr, :pess_bairro, 
										:pess_muni_ibge, :pess_cep, :pess_fone, :pess_cnpj_cpf,	
										:pess_dt_aber_nasc, :pess_tp_pessoa, :pess_esta_ibge 
							)";
							$insPessDestino = $conn->prepare( $sqlPessoaDestino );
										
							$insPessDestino->bindParam(':pess_nm'	 		, $dest_xNome);
							$insPessDestino->bindParam(':pess_apld'  		, $dest_xFant);
							$insPessDestino->bindParam(':pess_end'	 		, $dest_xLgr );	
							$insPessDestino->bindParam(':pess_end_nr'		, $dest_nro  );
							$insPessDestino->bindParam(':pess_bairro'		, $dest_xBairro);
							$insPessDestino->bindValue(':pess_muni_ibge'	, $dest_cMun );
							$insPessDestino->bindParam(':pess_cep'	 		, $dest_CEP  );
							$insPessDestino->bindParam(':pess_fone'	 		, $dest_fone );
							$insPessDestino->bindParam(':pess_cnpj_cpf'		, $campos[36]);			
							$insPessDestino->bindParam(':pess_dt_aber_nasc'	, $pedi_dtemissao);			
							$insPessDestino->bindParam(':pess_tp_pessoa'	, $pess_tp_pessoa);
							$insPessDestino->bindValue(':pess_esta_ibge'	, $pess_dest_cUF );
									
							if ( $insPessDestino->execute() )
							{
								$insPessDestino->closeCursor();								
								$campos[87] = $conn->lastInsertId();
								$sqldest="INSERT INTO cada_destinatario ( dest_id ) 
										  VALUES ( :p_dest_id )";
								$insDestinatario = $conn->prepare( $sqldest );
								$insDestinatario->bindParam(':p_dest_id' , $campos[87] );
								$insDestinatario->execute();
								$insDestinatario->closeCursor();
								$campos[0]  = 0;
							} else {
								$campos[0]  = 1;
								$campos[87] = 'Falha Insercao Pessoa Destino';
							}

						}
				}
            }
		}
		
//------------------------------------------------Pedido---------------------------------------------------
		
		if ( $campos[0]==0 )
		{
						$inspedido="INSERT INTO cada_pedidos ( 
									pedi_id_tra, pedi_id_ven, pedi_id_cli, pedi_flag,
									pedi_codigo, pedi_nm, pedi_tp, pedi_base, pedi_valoricms,
									pedi_valoripi, pedi_valorfrete, pedi_valorseguro, pedi_tnota,
									pedi_placa, pedi_nrvolumes, pedi_especie, pedi_pesol, pedi_pesob,
									pedi_dtemissao, pedi_nrnf, pedi_natOp, 
									pedi_CRT, pedi_chave_sefaz , pedi_id_rem, pedi_id_des
								) VALUES (
								    :pedi_id_tra, :pedi_id_ven, :pedi_id_cli, :pedi_flag,
									:pedi_codigo, :pedi_nm, :pedi_tp, :pedi_base, :pedi_valoricms, 
									:pedi_valoripi, :pedi_valorfrete, :pedi_valorseguro, :pedi_tnota,
									:pedi_placa, :pedi_nrvolumes, :pedi_especie, :pedi_pesol, :pedi_pesob,
									:pedi_dtemissao, :pedi_nrnf, :pedi_natOp, 
									:pedi_CRT, :pedi_chsefaz, :pedi_id_rem, :pedi_id_des
								)";
			try
			{								
						$inserePedido = $conn->prepare( $inspedido );
						
						$inserePedido->bindValue(':pedi_id_tra'	, $pedi_id_tra );
						$inserePedido->bindValue(':pedi_id_ven'	, $pedi_id_ven );
						$inserePedido->bindValue(':pedi_id_cli'	, $campos[86]  );
						$inserePedido->bindValue(':pedi_flag'	, $pedi_flag   );
						$inserePedido->bindParam(':pedi_codigo'	, $pedi_codigo );
						$inserePedido->bindParam(':pedi_nm'	   	, $emit_xNome  );
						$inserePedido->bindParam(':pedi_tp'	   	, $icms_vBC    );
						$inserePedido->bindParam(':pedi_base'	, $icms_vBC    );
						$inserePedido->bindParam(':pedi_valoricms'	, $icms_vICMS );
						$inserePedido->bindParam(':pedi_valoripi'	, $icms_vIPI  );
						$inserePedido->bindParam(':pedi_valorfrete'	, $icms_vFrete);
						$inserePedido->bindParam(':pedi_valorseguro', $icms_vSeg  );
						$inserePedido->bindParam(':pedi_tnota'  	, $icms_vBC   );
						$inserePedido->bindParam(':pedi_placa'  	, $pedi_placa );
						$inserePedido->bindParam(':pedi_nrvolumes'  , $tran_qVol  );
						$inserePedido->bindParam(':pedi_especie'	, $tran_esp   );
						$inserePedido->bindParam(':pedi_pesol'		, $tran_pesoL );
						$inserePedido->bindParam(':pedi_pesob'		, $tran_pesoB );
						$inserePedido->bindParam(':pedi_dtemissao'	, $pedi_dtemissao);
						$inserePedido->bindParam(':pedi_nrnf'       , $ide_nNF	  );
						$inserePedido->bindParam(':pedi_chsefaz', $pedi_chsefaz);
						$inserePedido->bindParam(':pedi_natOp'	, $ide_natOp);
						$inserePedido->bindParam(':pedi_CRT'	, $emit_CRT  );
						$inserePedido->bindParam(':pedi_id_rem'	, $campos[86]);
						$inserePedido->bindParam(':pedi_id_des'	, $campos[87]);
						$inserePedido->execute();
						
						$inserePedido->closeCursor();
						if( $inserePedido->rowCount()>0 ){
							$campos[88]	= $conn->lastInsertId(); //id Pedido
						} else {
							$campos[0] = 1;
							$campos[88]	= 'Falha na Insercao do Pedido';
						}						
			}	
			catch(PDOException $e)	
			{
				$campos[0] = 1;
				$campos[88] = 'ERROR: ' . $e->getMessage();
			} 
			
		}

	}	
	catch(PDOException $e)	
	{
			$campos[0] = 1;
			$campos[86] = 'ERROR: ' . $e->getMessage();
	} 
	
}
						
$objretorno = implode('|',$campos);

echo $objretorno;
	
?>
