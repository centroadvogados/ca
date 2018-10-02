<?php
 session_start();
 ini_set('display_errors', 'On' );
 error_reporting(E_ALL);
 date_default_timezone_set('America/Sao_Paulo');
 $param	   =   $_POST['param'];
 $data     =   explode("-",date('d-m-Y'));
 $hora     =   explode(":",date('H:i:s'));
 $dt	   =   $data[0].$data[1].$data[2];
 $hr	   =   $hora[0].$hora[1].$hora[2];
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt">

	<head>
    <script>
		$(document).ready(function() {
			$('#tabbela').DataTable({
					responsive: true
			});
		});
    </script>
	</head>
	
<body onLoad="if(ieBlink){setInterval('doBlink()',450)}" scrollbars="yes">

        <div class="row modal-header" style="background: #d9edf7; border-radius: 10px 10px 0px 0px; max-height:50px;">
		
            <div id="pedidos" class="col-lg-12">
			    <table id="tabbela" class="table-striped table-bordered table-hover table"><!-- estilo da tabela zebra, borda, focus e	responsiva-->
					<a href="javascript:fecha_tabela()"><img src='imgs/btn_x.png' alt='Fecha Janela' class='direita' /></a>
					<h3 class="modal-title" style="font-weight:bold; font-size:20pt; color:#4F94CD">Pedidos Identifica&ccedil;&atilde;o</h3>
					    
                    <br><div><a href="javascript:novo_registro(0,0,5,0)"  class=" "><img src="imgs/ico_produtos.png"> Novo Registro </img></a></div><br>
					
								<thead>
	                                <tr>
                                        <th><center>NR.COLETA</center></th>
                                        <th><center>CLIENTE</center></th>
                                        <th class='de600'><center>EMISS&Atilde;O</center></th>
                                        <th class='ate900'><center>P.Bruto</center></th>
                                        <th class='de600'><center>VOL(s)</center></th>
										<th class='de600'><center>Nr. NF</center></th>
                                        <th class='ate900'><center>CHAVE NF</center></th>
							
 									</tr>
								</thead>
								<?php
									function __autoload($classe) {
										$pastas = array('../../classes/conexao');
										foreach ($pastas as $pasta)	{
											if (file_exists("{$pasta}/{$classe}.class.php"))
											{
												include_once "{$pasta}/{$classe}.class.php";
											}
										}
									}
									
									if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){

										$type    	= $cfg['conexao']['type'];
										$host    	= $cfg['conexao']['host'];
										$user       = $cfg['conexao']['user'];
										$pass       = $cfg['conexao']['pass'];
										$name       = $cfg['conexao']['name'];
										$port    	= $cfg['conexao']['port'];
										$n1			= $cfg['nivel']['n1'];
										$n2			= $cfg['nivel']['n2'];
										$n3			= $cfg['nivel']['n3'];
										$n4			= $cfg['nivel']['n4'];

									//----------- Conexao a Base de Dados--------------------------------------------------------------------------		
									try {
										    $conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
											$consulta = $conn->prepare("SELECT
																		pedi_id, pedi_id_tra, pedi_id_ven, pedi_id_cli, pedi_codigo, 
																		pedi_nm, pedi_flag, pedi_tp, pedi_base, pedi_valoricms, pedi_valoripi, 
																		pedi_valorfrete, pedi_valorseguro, pedi_tnota, pedi_placa, pedi_nrvolumes,
																		pedi_especie, pedi_pesol, pedi_pesob, pedi_dtemissao, pedi_dtcoleta, 
																		pedi_dtsaida, pedi_dtentrega, pedi_via, pedi_condvenda, pedi_formpag,
																		pedi_nrnf, pedi_nfemitida, pedi_desconto, pedi_descsobre, pedi_confirmado,
																		pedi_imp, pedi_impboleto, pedi_impdup, pedi_obs1, pedi_obs2, pedi_marcado,
																		pedi_esta_ibge_or, pedi_esta_ibge_dn, pedi_muni_ibge_or, pedi_muni_ibge_dn,
																		pedi_id_rem, pedi_id_des, pedi_fun_id, pess_id, 
																		pess_nm, pess_email, pedi_chave_sefaz
																		FROM cada_pedidos AS pd	
																		INNER JOIN cada_pessoas AS p ON p.pess_id = pd.pedi_id_cli
																		ORDER BY pedi_id DESC
																	   ");
											$consulta->execute();
																						
											if ( $consulta->rowCount() )    
											{
												// percorre os resultados via iteração
												foreach($consulta as $row){				
													// exibe os resultados
													$pedi_id 		 = $row["pedi_id"];
													$pedi_id_tra	 = $row["pedi_id_tra"];
													$pedi_id_ven	 = $row["pedi_id_ven"];
													$pedi_id_cli 	 = $row["pedi_id_cli"];
													$pedi_codigo	 = $row["pedi_codigo"];
													$pedi_nm 		 = $row["pess_nm"];
													$pedi_flag 		 = $row["pedi_flag"];
													$pedi_tp		 = $row["pedi_tp"];
													$pedi_base		 = $row["pedi_base"];
													$pedi_valoricms  = $row["pedi_valoricms"];
													$pedi_valoripi	 = $row["pedi_valoripi"];
													$pedi_valorfrete = $row["pedi_valorfrete"];
													$pedi_valorseguro= $row["pedi_valorseguro"];
													$pedi_tnota		 = $row["pedi_tnota"];
													$pedi_placa		 = $row["pedi_placa"];
													$pedi_nrvolumes	 = $row["pedi_nrvolumes"];
													$pedi_especie	 = $row["pedi_especie"];	
													$pedi_pesol		 = $row["pedi_pesol"];
													$pedi_pesob		 = $row["pedi_pesob"];	
													$pedi_dtemissao  = $row["pedi_dtemissao"];
													$pedi_dtcoleta	 = $row["pedi_dtcoleta"]; 
													$pedi_dtsaida	 = $row["pedi_dtsaida"];
													$pedi_dtentrega	 = $row["pedi_dtentrega"];
													$pedi_via		 = $row["pedi_via"];
													$pedi_condvenda  = $row["pedi_condvenda"];
													$pedi_formpag	 = $row["pedi_formpag"]; 	
													$pedi_nrnf		 = $row["pedi_nrnf"];	
													$pedi_nfemitida	 = $row["pedi_nfemitida"];
													$pedi_desconto   = $row["pedi_desconto"];
													$pedi_descsobre  = $row["pedi_descsobre"];
													$pedi_confirmado = $row["pedi_confirmado"];
													$pedi_imp        = $row["pedi_imp"];
													$pedi_impboleto  = $row["pedi_impboleto"];
													$pedi_impdup     = $row["pedi_impdup"];
													$pedi_obs1		 = $row["pedi_obs1"];
													$pedi_obs2		 = $row["pedi_obs2"];
													$pedi_marcado    = $row["pedi_marcado"];
													$pedi_esta_ibge_or = $row["pedi_esta_ibge_or"];
													$pedi_esta_ibge_dn = $row["pedi_esta_ibge_dn"];
													$pedi_muni_ibge_or = $row["pedi_muni_ibge_or"];
													$pedi_muni_ibge_dn = $row["pedi_muni_ibge_dn"];
													$pedi_id_rem       = $row["pedi_id_rem"];
													$pedi_id_des	   = $row["pedi_id_des"];
													$pedi_fun_id	   = $row["pedi_fun_id"];
													$pedi_email		   = $row["pess_email"];
													$pedi_chave_sefaz  = $row["pedi_chave_sefaz"];
													
										            If ($pedi_flag==1) {  
														$botao = "<img src=$n4.'htms/imgs/informacoes.gif' border=0>"; 
													} else {
														$botao = "<img src=$n4.'htms/imgs/x.png' border=0>"; 
													}
													
													$dados	= array(0  => $pedi_id,
																			  1  =>	$pedi_id_tra     ,
																			  2  =>	$pedi_id_ven     ,
																			  3  =>	$pedi_id_cli     ,
																			  4  =>	$pedi_codigo     ,
																			  5  =>	$pedi_nm         , 	
																			  6  =>	$pedi_flag       , 	
																			  7  =>	$pedi_tp         ,	
																			  8  =>	$pedi_base       ,	
																			  9  =>	$pedi_valoricms  ,
																			  10 =>  $pedi_valoripi  ,
																			  11 =>  $pedi_valorfrete,
																			  12 =>  $pedi_valorseguro,
																			  13 =>  $pedi_tnota     ,				 
																			  14 =>  $pedi_placa     ,				
																			  15 =>  $pedi_nrvolumes ,		
																			  16 =>  $pedi_especie   ,		  
																			  17 =>  $pedi_pesol     ,				
																			  18 =>  $pedi_pesob     ,			  
																		  	  19 =>  $pedi_dtemissao ,    
																			  20 =>  $pedi_dtcoleta  ,		  
																			  21 =>  $pedi_dtsaida   ,		  
																			  22 =>  $pedi_dtentrega ,		
																			  23 =>  $pedi_via       ,				 
																			  24 =>  $pedi_condvenda ,   
																			  25 =>  $pedi_formpag   ,	    
																			  26 =>  $pedi_nrnf      ,			    
																			  27 =>  $pedi_nfemitida ,		 
																			  28 =>  $pedi_desconto  ,     
																			  29 =>  $pedi_descsobre ,    
																			  30 =>  $pedi_confirmado,   
																			  31 =>  $pedi_imp       ,   
																			  32 =>  $pedi_impboleto ,   
																			  33 =>  $pedi_impdup    ,   
																			  34 =>  $pedi_obs1		 ,  
																			  35 =>  $pedi_obs2		 ,  
																			  36 =>  $pedi_marcado    ,  
																			  37 =>  $pedi_esta_ibge_or	,	
																			  38 =>  $pedi_esta_ibge_dn	,   
																			  39 =>  $pedi_muni_ibge_or	,  
																			  40 =>  $pedi_muni_ibge_dn ,  
																			  41 =>  $pedi_id_rem ,               
																			  42 =>  $pedi_id_des , 				
																			  43 =>  $pedi_fun_id ,				 
																	          44 =>  $pedi_email  ,
																			  45 =>  $pedi_chave_sefaz	
																	);
															
													$objretorno = implode('|',$dados);
                                                    //----------------------------------------------------------------													
								?>
													
													<tr>
														<td><a href="javascript:abre_registro('<?=$pedi_id;?>','<?=$objretorno;?>','<?=$param;?>')">
														    <center><?=substr($pedi_codigo,0,16);?></center></a>
														</td>
														<td><center><?=substr(utf8_encode($pedi_nm),0,9);?></center></td>
														<td class='de600'><center><?=date("d/m/Y", strtotime($pedi_dtemissao));?></center></td>
														<td class='ate900'><center><?=$pedi_pesob;?></center></td>
														<td class='de600'><center><?=$pedi_nrvolumes;?></center></td>
														<td class='de600'><center><?=$pedi_nrnf;?></center></td>
														<td class='ate900'><center style="font-size:10pt; color:#000"><?=substr(utf8_encode($pedi_chave_sefaz),0,44);?></center></td>
													</tr>
											        
								<?php	
												}
											}
									    } catch ( PDOException $e ) {
											echo 'Erro ao Conectar com o MySql:' . $e->getMessage();
										}	
									} 							
										
								?>		
				</table>
			</div>
        </div>
</body>

</html>