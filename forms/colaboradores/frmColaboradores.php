<?php
 session_start();
 $param  	= $_POST['param'];
 $modulo 	= 2;
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
            <div class="col-lg-12">
			    <table id="tabbela" class="table-striped table-bordered table-hover table"><!-- estilo da tabela zebra, borda, focus e		responsiva-->
					<a href="javascript:fecha_tabela()"><img src='imgs/btn_x.png' alt='Fecha Janela' class='direita' /></a>
					<h3 class="modal-title" style="font-weight:bold; font-size:20pt; color:#4F94CD">Colaboradores</h3> 
								<thead>
	                                <tr>
                                        <th><center>NOME</center></th>
                                        <th><center>ENDERE&Ccedil;O</center></th>
                                        <th><center>FONE</center></th>
                                        <th class='de600'><center>ESTADO</center></th>
                                        <th class='de600'><center>CIDADE</center></th>
                                        <th class='ate900'><center>CONTATO</center></th>
 									</tr>
								</thead>
								<?php
 								  if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){
										$type    	= $cfg['conexao']['type'];
										$host    	= $cfg['conexao']['host'];
										$user       = $cfg['conexao']['user'];
										$pass       = $cfg['conexao']['pass'];
										$name       = $cfg['conexao']['name'];
										$port    	= $cfg['conexao']['port'];
									    $n2	    	= $cfg['nivel']['n2'];
									  
									    function __autoload($classe) {
												$pastas = array('$n2.classes/conexao');
												foreach ($pastas as $pasta)	{
													if ( file_exists("{$pasta}/{$classe}.class.php") ) {
														include_once "{$pasta}/{$classe}.class.php";
													}
												}
										}
									//----------- Conexao a Base de Dados--------------------------------------------------------------------------		
									 
										    $conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
											// instancia objeto PDO, conectando MySql, executa uma instrução SQL de consulta
											$consulta = $conn->prepare("SELECT p.pess_id, p.pess_nm, pess_apld, p.pess_end, p.pess_end_nr,
																		p.pess_compl, p.pess_bairro, p.pess_cep, p.pess_tel, p.pess_fax,
																		p.pess_cnpj_cpf, p.pess_insc_rg , p.pess_dt_aber_nasc, p.pess_contato, 
																		p.pess_site, p.pess_email, p.pess_dt_inc, p.pess_tp_pessoa, p.pess_delete, 
																		p.esta_ibge, p.muni_ibge, p.pess_senha, p.pess_cli, p.pess_for, p.pess_usu, 
																		p.pess_ven, p.pess_fun, p.pess_obs,
																	    f.fun_id,f.fun_vl_limite_cred,f.fun_publicidade,f.fun_atividade_cnae,f.fun_val_cnh,
																	    f.fun_reg_cnh, f.fun_first_cnh, f.fun_emi_cnh, f.fun_cat_cnh, f.fun_comissao, 
																		f.fun_terceiro, f.fun_id_cbo, f.veic_id, f.ativ_cod_cbo, f.fun_obs,
																		e.esta_ibge, e.esta_nm, e.esta_uf, 
																		m.muni_ibge, m.muni_nm, m.esta_ibge,
																		a.ativ_funcao
																		FROM cada_pessoas AS p
																		INNER JOIN cada_estados      AS e ON p.esta_ibge = e.esta_ibge
																		INNER JOIN cada_municipios   AS m ON m.muni_ibge = p.muni_ibge
																		INNER JOIN cada_funcionarios AS f ON p.pess_id   = f.fun_id 
																		INNER JOIN cada_veiculos     AS v ON v.veic_id   = f.veic_id 
																		INNER JOIN cada_atividades   AS a ON f.fun_id_cbo= a.ativ_id 	
																		"); 
																		
											$consulta->execute();

											if ( $consulta->rowCount() )    
											{
												// percorre os resultados via iteração
												foreach($consulta as $row){				
													// exibe os resultados
													$pess_id 			= $row["pess_id"];
													$pess_nm 			= $row["pess_nm"];
													$pess_apld 			= $row["pess_apld"];
													$pess_end 			= $row["pess_end"];
													$pess_end_nr	  	= $row["pess_end_nr"];
													$pess_compl 	  	= $row["pess_compl"];
													$pess_bairro	    = $row["pess_bairro"];	 
													$pess_cep 			= $row["pess_cep"];
													$pess_tel 			= $row["pess_tel"];
													$pess_fax 			= $row["pess_fax"];
													$pess_cnpj_cpf 		= $row["pess_cnpj_cpf"];
													$pess_insc_rg 		= $row["pess_insc_rg"];
													$pess_dt_aber_nasc 	= $row["pess_dt_aber_nasc"];
													$pess_contato 		= $row["pess_contato"];
													$pess_site 			= $row["pess_site"];
													$pess_email 		= $row["pess_email"];
													$pess_dt_inc 		= $row["pess_dt_inc"];
													$pess_tp_pessoa    	= $row["pess_tp_pessoa"];
													$pess_delete 		= $row["pess_delete"];
													$pess_esta_ibge 	= $row["esta_ibge"];
													$pess_muni_ibge	   	= $row["muni_ibge"];
													$pess_senha 		= $row["pess_senha"];	
													$pess_cli			= $row["pess_cli"]; 
													$pess_for			= $row["pess_for"]; 
													$pess_usu			= $row["pess_usu"]; 
													$pess_ven			= $row["pess_ven"]; 
													$pess_fun 			= $row["pess_fun"];
													$pess_obs 			= $row["pess_obs"];
													$esta_nm 			= $row["esta_nm"];
													$esta_uf			= $row["esta_uf"];
													$muni_nm 			= $row["muni_nm"]; 
													$fun_id 			= $row["fun_id"];
													$fun_vl_limite_cred	= $row["fun_vl_limite_cred"];
													$fun_publicidade	= $row["fun_publicidade"];
													$fun_atividade_cnae = $row["fun_atividade_cnae"]; 
													$fun_val_cnh		= $row["fun_val_cnh"];
													$fun_reg_cnh		= $row["fun_reg_cnh"];
													$fun_first_cnh		= $row["fun_first_cnh"];
													$fun_emi_cnh		= $row["fun_emi_cnh"];
													$fun_cat_cnh 		= $row["fun_cat_cnh"];
													$fun_comissao 	  	= $row["fun_comissao"];
													$fun_terceiro		= $row["fun_terceiro"];
													$fun_id_cbo			= $row["fun_id_cbo"];
													$veic_id			= $row["veic_id"];
													$ativ_cod_cbo	   	= $row["ativ_cod_cbo"];
													$fun_obs			= $row["fun_obs"];
													//----------------------------------------------------------------------------------------------------------------
													$telefones = $conn->prepare("SELECT tele_id, tele_tel, tele_contato, oper_id, pess_id 
																				FROM cada_telefones 
																				WHERE tele_id = :codfone; ");
													$telefones->bindParam( ':codfone', $pess_tel, PDO::PARAM_INT );  
													$telefones->execute();
													
													foreach ( $telefones->fetchAll(PDO::FETCH_ASSOC) as $fone ){
														$tele_id			=	$fone["tele_id"];
														$tele_tel			=	$fone["tele_tel"];
														$tele_contato 	= 	$fone["tele_contato"];
													}
													//----------------------------------------------------------------------------------------------------------------
													$dados	= array( 
																	 0  =>	$pess_id,
																	 1  =>  $param,
 																	 2  =>  $modulo, 
	               													 3  =>	$pess_nm,
																	 4  =>	$pess_apld,
																	 5  =>	$pess_end,
	   																 6  =>	$pess_end_nr,
																	 7  =>	$pess_compl,
																	 8  =>	$pess_bairro,
																	 9  =>	$pess_cep,
																	 10 =>	$pess_tel,
																	 11 =>	$pess_fax,
																	 12 =>	$pess_cnpj_cpf,
																	 13 =>	$pess_insc_rg,
																	 14 =>	$pess_dt_aber_nasc,
																	 15 =>	$pess_contato,
																	 16 =>	$pess_site,
																	 17 =>	$pess_email,
																	 18 =>	$pess_dt_inc,
																	 19 =>	$pess_tp_pessoa,
																	 20 =>	$pess_delete,
																	 21 =>	$pess_esta_ibge,
																	 22 =>	$pess_muni_ibge,
																	 23 =>	$pess_senha,
																	 24 =>	$pess_cli,
																	 25 =>	$pess_for,
																	 26 =>  $pess_usu,
																	 27 =>	$pess_ven,
																	 28 =>	$pess_fun,
																	 29 =>	$pess_obs,
																	 30 =>  $esta_nm,
																	 31 =>  $esta_uf,	
																	 32 =>  $muni_nm,
																	 33 =>  $fun_id,
																	 34 =>  $fun_vl_limite_cred,
																	 35 =>  $fun_publicidade,
																	 37 =>  $fun_atividade_cnae,
																	 38 =>  $fun_val_cnh,
																	 39 =>  $fun_reg_cnh,
																	 40 =>  $fun_first_cnh,
																	 41 =>  $fun_emi_cnh,
																	 42 =>  $fun_cat_cnh,
																	 43 =>  $fun_comissao,
																	 44 =>  $fun_terceiro,
																	 45 =>  $fun_id_cbo,
																	 46 =>  $veic_id,
																	 47 =>  $ativ_cod_cbo,
																	 48 =>  $fun_obs
												 ); 				
												$objretorno = implode('|',$dados);
												//----------------------------------------------------------------------------------------------------------------	
								?>            <tr>
														<td><a href="javascript:abre_registro('<?=$pess_id;?>','<?=$objretorno;?>','<?=$param;?>','<?=$modulo;?>')">
														    <center><?=substr(utf8_encode($pess_nm),0,40);?></center></a>
														</td>
														<td><center><?=substr(utf8_encode($pess_end),0,20);?></center></td>
														<td><center><?=$tele_tel;?></center></td>
														<td class='de600'><center><?=utf8_encode( $esta_uf );?></center></td>
														<td class='de600'><center><?=substr(utf8_encode( $muni_nm ),0,13);?></center></td>
														<td class='ate900'><center><?=substr(utf8_encode($pess_contato),0,9);?></center></td>
												</tr>
											        
<?php	                                 }    
										}
								} 							
										
?>		
				</table>
			</div>
        </div>
</body>

</html>