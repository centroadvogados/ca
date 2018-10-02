<?php
 session_start();
 $param  = $_POST['param'];
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

        <div class="row">
            <div class="col-lg-12"><br>
						<!--<a href="javascript:fecha_tabela()"><img src='imgs/remove.png' alt='Fecha Janela' class='direita' style='padding: 15px 0px;'/></a>-->
						<a href="home"><img src='imgs/remove.png' alt='Fecha Janela' class='direita'/></a>
						<h3>Dados - Cadastros</h3>
						    
							<table id="tabbela" class="table-striped table-bordered table-hover table"><!-- estilo da tabela zebra, borda, focus e responsiva-->
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
										$user    	= $cfg['conexao']['user'];
										$pass       = $cfg['conexao']['pass'];
										$name       = $cfg['conexao']['name'];
										$port    	= $cfg['conexao']['port'];
										$n2	    	= $cfg['nivel']['n2'];
										
										function __autoload($classe)
										{
											$pastas = array('$n2.classes/conexao');
											foreach ($pastas as $pasta)	{
												if (file_exists("{$pasta}/{$classe}.class.php"))
												{
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
																		e.esta_ibge, e.esta_nm, e.esta_uf, 
																		m.muni_ibge, m.muni_nm, m.esta_ibge
																		FROM cada_pessoas AS p
																		INNER JOIN cada_estados      AS e ON p.esta_ibge=e.esta_ibge
																		INNER JOIN cada_municipios   AS m ON m.muni_ibge=p.muni_ibge
																		"); 
																		
																		
																		
/*
																"SELECT p.pess_id, p.pess_nm, pess_apld, p.pess_end, p.pess_end_nr,
																		p.pess_compl, p.pess_bairro, p.pess_cep, p.pess_tel, p.pess_fax,
																		p.pess_cnpj_cpf, p.pess_insc_rg , p.pess_dt_aber_nasc, p.pess_contato, 
																		p.pess_site, p.pess_email, p.pess_dt_inc, p.pess_tp_pessoa, p.pess_delete, 
																		p.esta_ibge, p.muni_ibge, p.pess_senha, p.pess_cli, p.pess_for, p.pess_usu, 
																		p.pess_ven, p.pess_fun, p.pess_cli, p.pess_for, p.pess_usu, p.pess_ven, 
																		p.pess_fun, p.pess_obs,
															            f.fun_id,f.fun_vl_limite_cred,f.fun_publicidade,f.fun_atividade_cnae,f.fun_val_cnh,
																	    f.fun_reg_cnh, f.fun_first_cnh, f.fun_emi_cnh, f.fun_cat_cnh, f.fun_comissao, 
																		f.fun_terceiro, f.fun_id_cbo, f.veic_id, f.ativ_cod_cbo, f.fun_obs, a.ativ_funcao 	
																		e.esta_ibge, e.esta_nm, e.esta_uf, 
																		m.muni_ibge, m.muni_nm
																		FROM cada_pessoas AS p
																		INNER JOIN cada_estados      AS e ON p.esta_ibge=e.esta_ibge
																		INNER JOIN cada_municipios   AS m ON m.muni_ibge=p.muni_ibge
																		INNER JOIN cada_funcionarios AS f ON ( p.pess_id = f.fun_id )
																		INNER JOIN cada_veiculos     AS v ON ( v.veic_id = f.veic_id )
																		INNER JOIN cada_atividades   AS a ON ( f.fun_id_cbo = a.ativ_id )
																		"																		
*/																		
																		
																		
											$consulta->execute();
																						
											//$retorno = $consulta->rowCount();						   
															   
										   //if ( $retorno>0 ) 
											if ( $consulta->rowCount() )    
											{
												// percorre os resultados via iteração
												foreach($consulta as $row){				
													// exibe os resultados
													$pess_id 			= $row["pess_id"];
													$pess_nm 			= $row["pess_nm"];
													$pess_apld 			= $row["pess_apld"];
													$pess_end 			= $row["pess_end"];
													$pess_end_nr		= $row["pess_end_nr"];
													$pess_compl 		= $row["pess_compl"];
													$pess_bairro		= $row["pess_bairro"];	 
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
													$pess_tp_pessoa 	= $row["pess_tp_pessoa"];
													$pess_delete 		= $row["pess_delete"];
													$pess_esta_ibge 	= $row["esta_ibge"];
													$pess_muni_ibge		= $row["muni_ibge"];
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
													
													$dados	= array( 0  =>	$pess_id, 			
																	 1  =>	$pess_nm,
																	 2  =>	$pess_apld,
																	 3  =>	$pess_end,
																	 4  =>	$pess_end_nr,
																	 5  =>	$pess_compl,
																	 6  =>	$pess_bairro,
																	 7  =>	$pess_cep,
																	 8  =>	$pess_tel,
																	 9  =>	$pess_fax,
																	 10 =>	$pess_cnpj_cpf,
																	 11 =>	$pess_insc_rg,
																	 12 =>	$pess_dt_aber_nasc,
																	 13 =>	$pess_contato,
																	 14 =>	$pess_site,
																	 15 =>	$pess_email,
																	 16 =>	$pess_dt_inc,
																	 17 =>	$pess_tp_pessoa,
																	 18 =>	$pess_delete,
																	 19 =>	$pess_esta_ibge,
																	 20 =>	$pess_muni_ibge,
																	 21 =>	$pess_senha,
																	 22 =>	$pess_cli,
																	 23 =>	$pess_for,
																	 24 =>  $pess_usu,
																	 25 =>	$pess_ven,
																	 26 =>	$pess_fun,
																	 27 =>	$pess_obs,
																	 28 =>  $esta_nm,
																	 29 =>  $esta_uf,	
																	 30 =>  $muni_nm
													); 
															
													$objretorno = implode('|',$dados);
//-------------------------------------------------------------------------------------------------------------------------------------												
													$telefones = $conn->prepare("SELECT tele_id, tele_tel, tele_contato, oper_id, pess_id 
																				FROM cada_telefones 
																				WHERE tele_id = :codfone; ");
													$telefones->bindParam( ':codfone', $pess_tel, PDO::PARAM_INT );  
													$telefones->execute();
													

													foreach ( $telefones->fetchAll(PDO::FETCH_ASSOC) as $fone ){
														$tele_id			=	$fone["tele_id"];
														$tele_tel			=	$fone["tele_tel"];
														$tele_contato 		= 	$fone["tele_contato"];
														}												
												
								?>
													
													<tr>
														<td><a href="javascript:abre_registro('<?=$pess_id;?>','<?=$objretorno;?>','<?=$param;?>')">
														    <center><?=substr(utf8_encode($pess_nm),0,28);?></center></a>
														</td>
														<td><center><?=substr(utf8_encode($pess_end),0,15);?></center></td>
														<td><center><?=$tele_tel;?></center></td>
														<td class='de600'><center><?=utf8_encode( $esta_uf );?></center></td>
														<td class='de600'><center><?=substr(utf8_encode( $muni_nm ),0,10);?></center></td>
														<td class='ate900'><center><?=substr(utf8_encode($pess_contato),0,8);?></center></td>
													</tr>
											        
								<?php	
												}
											}
									} 							
										
								?>		
							</table>
			            </div>
        </div>
</body>

</html>