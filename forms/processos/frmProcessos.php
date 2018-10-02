<?php
 session_start();
 $param=$_POST['param'];
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

        <div class="row modal-header" style="rgba(217, 237, 247, 0.32); border-radius: 10px 10px 0px 0px; max-height:50px;">
			
            <div id="processos" class="col-lg-12">
			    <table id="tabbela" class="table-striped table-bordered table-hover table"><!-- estilo da tabela zebra, borda, focus e	responsiva-->
					<!--<a href="javascript:fecha_tabela()"><img src='imgs/btn_x.png' alt='Fecha Janela' class='direita' /></a>-->
					<a href="home"><img src='imgs/remove.png' alt='Fecha Janela' class='direita' style='padding: 15px 0px;'/></a>
					<h3 class="modal-title" style="font-weight:bold; font-size:20pt; color:#4F94CD">Processos</h3> 
						<a href="construcao"><h5 class="modal-title" style="font-weight:bold; color:#4F94CD; align:left"><img src='imgs/icone/file.png' alt='Fecha Janela' />&emsp;Novo Registro</h5></a>
								<thead>
	                                <tr>
                                        <th><center>PROCESSO</center></th>
                                        <th><center>NOME</center></th>
                                        <th class='ate900'><center>INICIO</center></th>
										<th class='de600'><center>MOVIMENTA&Ccedil;&Atilde;O</center></th>
                                        <th class='ate900'><center>TIPO</center></th>
 									</tr>
								</thead>
								<?php
									function __autoload($classe)
									{
										$pastas = array('../../classes/conexao');
										foreach ($pastas as $pasta)	{
											if (file_exists("{$pasta}/{$classe}.class.php"))
											{
												include_once "{$pasta}/{$classe}.class.php";
											}
										}
									}
									
									if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){

										$type    	= $cfg['protocolo3']['type'];
										$host    	= $cfg['protocolo3']['host'];
										$user       = $cfg['protocolo3']['user'];
										$pass       = $cfg['protocolo3']['pass'];
										$name       = $cfg['protocolo3']['name'];
										$port    	= $cfg['protocolo3']['port'];
										
										$img		= $cfg['local']['imagem'];

										//----------- Conexao a Base de Dados-----------------------		
									 
										$conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
										$consulta = $conn->prepare("
										SELECT pr.proc_id, pr.proc_documento, pr.proc_assunto, pr.proc_desc, pr.proc_data, 
											   pr.proc_alteradopor, pr.proc_alteradoem, pr.proc_caixa, pr.proc_setorarquivado,
											   pr.proc_id_pessoa, pr.proc_tipo_nu_id, pr.proc_rito_id,
											   p.pess_id, p.pess_nm, pess_apld, p.pess_end, p.pess_end_nr,
											   p.pess_compl, p.pess_bairro, p.pess_cep, p.pess_tel, p.pess_fax,
											   p.pess_cnpj_cpf, p.pess_insc_rg , p.pess_dt_aber_nasc, p.pess_contato, 
											   p.pess_site, p.pess_email, p.pess_dt_inc, p.pess_tp_pessoa, p.pess_delete, 
											   p.esta_ibge, p.muni_ibge, p.pess_senha, p.pess_cli, p.pess_for, p.pess_usu, 
											   p.pess_ven, p.pess_fun, p.pess_obs,
											   e.esta_nm, e.esta_uf,
											   m.muni_nm
										FROM protocolo3.prot_processos AS pr
										INNER JOIN aquitudo_att.cada_pessoas    AS p ON pr.proc_id_pessoa=p.pess_id	
										INNER JOIN aquitudo_att.cada_estados    AS e ON p.esta_ibge=e.esta_ibge
										INNER JOIN aquitudo_att.cada_municipios AS m ON m.muni_ibge=p.muni_ibge
										ORDER BY proc_documento DESC
										");
											$consulta->execute();
																						
											if ( $consulta->rowCount() )    
											{
												// percorre os resultados via iteração
												foreach($consulta as $row){				
													// exibe os resultados
													$proc_id			= $row["proc_id"];
													$proc_documento	  	= $row["proc_documento"];
													$proc_assunto		= $row["proc_assunto"];
													$proc_desc  	   	= $row["proc_desc"];
													$proc_data 		  	= $row["proc_data"];
													$proc_alteradopor	= $row["proc_alteradopor"];
													$proc_alteradoem	= $row["proc_alteradoem"];
													$proc_caixa		 	= $row["proc_caixa"];
													$proc_setorarquivado= $row["proc_setorarquivado"];
													
													$proc_pess_id		= $row["pess_id"];
													$proc_pess_nm		= $row["pess_nm"];
													$proc_pess_apld		= $row["pess_apld"];
													$proc_pess_end 		= $row["pess_end"];
													$proc_pess_end_nr	= $row["pess_end_nr"];
													$proc_pess_compl	= $row["pess_compl"];
													$proc_pess_bairro	= $row["pess_bairro"];
													$proc_pess_cep		= $row["pess_cep"];
													$proc_pess_tel		= $row["pess_tel"];
													$proc_pess_fax		= $row["pess_fax"];
													$proc_pess_cnpj_cpf	= $row["pess_cnpj_cpf"];
													
													$proc_pess_insc_rg 	= $row["pess_insc_rg"];
													$proc_pess_dt_aber_nasc= $row["pess_dt_aber_nasc"];
													$proc_pess_contato  = $row["pess_contato"];
													$proc_pess_site		= $row["pess_site"];
													$proc_pess_email	= $row["pess_email"];
													$proc_pess_dt_inc	= $row["pess_dt_inc"];
													$proc_pess_tp_pessoa= $row["pess_tp_pessoa"];
													$proc_pess_delete	= $row["pess_delete"];
													$proc_esta_ibge		= $row["esta_ibge"];
													$proc_muni_ibge		= $row["muni_ibge"];
													$proc_pess_senha	= $row["pess_senha"];
													$proc_pess_cli		= $row["pess_cli"];
													$proc_pess_for		= $row["pess_for"];
													$proc_pess_usu 		= $row["pess_usu"];
													$proc_pess_ven		= $row["pess_ven"];
													$proc_pess_fun		= $row["pess_fun"];
													$proc_pess_obs		= $row["pess_obs"];
													$proc_tipo_id		= $row["proc_tipo_nu_id"];
													if ($proc_tipo_id ==1){ $tippo = "Administrativo";}
													elseif ($proc_tipo_id ==2){ $tippo = "Judicial";}

										       
													$dados	= array(0  =>  $proc_id,
																	1  =>  $proc_documento,
																	2  =>  $proc_assunto,
																	3  =>  $proc_desc,
																    4  =>  $proc_data,
															    	5  =>  $proc_alteradopor, 	
																	6  =>  $proc_alteradoem, 	
																	7  =>  $proc_caixa,	
																	8  =>  $proc_setorarquivado,
																	
																	9  =>  $proc_pess_id,
																	10 =>  $proc_pess_nm,
																	11 =>  $proc_pess_apld,
																	12 =>  $proc_pess_end, 
																	13 =>  $proc_pess_end_nr,
																	14 =>  $proc_pess_compl,
																	15 =>  $proc_pess_bairro,
																	16 =>  $proc_pess_cep,
																	17 =>  $proc_pess_tel,
																	18 =>  $proc_pess_fax,
																	19 =>  $proc_pess_cnpj_cpf,
																	20 =>  $proc_pess_insc_rg,
																	
																	21 =>  $proc_pess_dt_aber_nasc,
																	22 =>  $proc_pess_contato, 
																	23 =>  $proc_pess_site,
																	24 =>  $proc_pess_email,
																	25 =>  $proc_pess_dt_inc,
																	26 =>  $proc_pess_tp_pessoa,
																	27 =>  $proc_pess_delete,
																	28 =>  $proc_esta_ibge,
																	29 =>  $proc_muni_ibge,
																	30 =>  $proc_pess_senha,
																	31 =>  $proc_pess_cli,
																	32 =>  $proc_pess_for,
																	33 =>  $proc_pess_usu,
																	34 =>  $proc_pess_ven,
																	35 =>  $proc_pess_fun,
																	36 =>  $proc_pess_obs,
																	37 =>  $proc_tipo_id,
																	38 =>  $tippo
																	);
															
													$objretorno = implode('|',$dados);													
													
//-------------------------------------------------------------------------------------------------------------------------------------													?>
													
													<tr>
														<td><a href="javascript:abre_registro('<?=$proc_id;?>','<?=$objretorno;?>','<?=$param;?>')">
														    <center><?=$proc_documento;?></center></a>
														</td>
														<td><center><?=substr(utf8_encode($proc_pess_nm),0,40);?></center></td>
														<td class='ate900'><center><?=date("d/m/Y", strtotime($proc_data));?></center></td>
														<td class='de600'><center><?=date("d/m/Y", strtotime($proc_alteradoem));?></center></td>
														<td class='ate900'><center><?=substr($tippo,0,3);?>
														</center></td>
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