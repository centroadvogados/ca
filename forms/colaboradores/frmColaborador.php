<?php
/* grupo usuario   1  - Usuario
					        10-	Administrador
					        20-	Supervisor
					        30-	Gerencia
					
usua_nivel		     0-  Desabilitado
					      	1-	Select				3-	Update
					      	2-	Insert			 	 4-	Delete
*/
session_start();
function __autoload($classe){
				$pastas = array('../../classes/conexao');
					foreach ($pastas as $pasta)	{
						if (file_exists("{$pasta}/{$classe}.class.php"))
						{  include_once "{$pasta}/{$classe}.class.php";  }
					}
}
			
if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){
		$type    	= $cfg['conexao']['type'];
		$host    	= $cfg['conexao']['host'];
		$user    	= $cfg['conexao']['user'];
		$pass       = $cfg['conexao']['pass'];
		$name       = $cfg['conexao']['name'];
		$port    	= $cfg['conexao']['port'];			
		$conn  	    = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);	
	
    	$id			=$_POST['id'];
    	$param	=$_POST['param'];
    	$modulo=$_POST['modulo'];
	
		$objeto			= $_POST['objeto'] .'<br>';
		$campo		  = explode("|", $objeto);

		$pess_id		 		   = $campo[0]; //pess_
	    $param			 		   = $campo[1];
	    $modulo		    		   = $campo[2];
	    $razao	  		  			 = $campo[3];
	    $nome	  		 			= $campo[4];
	    $end 	  		   			  = $campo[5];
	    $pess_end_nr		    = $campo[6];
	    $compl    	 	  			 = $campo[7];
	    $bairro   	  	   			  =$campo[8];
	    $cep	   			  		   =$campo[9];
	    $pess_tel		 			=$campo[10];
	    $pess_fax				   = $campo[11];
	    $cnpj_cpf 					= $campo[12];
	    $insc_rg			 		 = $campo[13];
	    $pess_dt_aber_nasc 	= $campo[14];
	    $contato			 		 = $campo[15];
	    $site							 = $campo[16];
	    $email				  		   = $campo[17];
	    $data_r			  			  = $campo[18];
	    $tp_pessoa		  		   = $campo[19];
	    $delete			  			   = $campo[20];
	    $id_esta_ibge		      = $campo[21];
	    $id_muni_ibge		  	 = $campo[22];
	    $pess_senha				 = $campo[23];
	    $pess_cli					 = $campo[24];
	    $pess_for				    = $campo[25];
	    $pess_usu				  = $campo[26];
	    $pess_ven				  = $campo[27];
	    $pess_fun				   = $campo[28];
	    $pess_obs				  = $campo[29];
	    $esta_nm				   = $campo[30];
	    $esta_uf					 = $campo[31];
	    $muni_nm				  = $campo[32];
	    $fun_id						  = $campo[33];
	    $fun_vl_limite_cred    = $campo[34];
	    $fun_publicidade		= $campo[35];
	    $fun_atividade_cnae  = $campo[36];
	    $fun_val_cnh			  = $campo[37];
	    $fun_reg_cnh			  = $campo[38];
	    $fun_first_cnh			   = $campo[39];
	    $fun_emi_cnh			 = $campo[40];
	    $fun_cat_cnh			  = $campo[41];
	    $fun_comissao		    = $campo[42];
	    $fun_terceiro			   = $campo[43];
	    $fun_id_cbo				   = $campo[44];
	    $veic_id					  = $campo[45];
	    $ativ_cod_cbo			 = $campo[46];
	    $ativ_cod_cbo			 = $campo[47];
	    $fun_obs				    = $campo[48];
	
if ($tp_pessoa=='F'){ $label1='CPF'; $label2='RG';} else { $label1='CNPJ'; $label2='IE';}

?>       <a href="javascript:fecha_registro()"><img src="imgs/btn_x_yellow.gif" alt="Fecha Janela" class="fecha_x direita" /></a>
			<ul class="nav nav-tabs nav-justified">
			  <li class="active"><a data-toggle="tab" href="#home"><b>Dados Gerais</b></a></li>
			  <li><a data-toggle="tab" href="#menu1"><b>Complementares</b></a></li>
			</ul>
		    <!-- inicio do formulario-->	
			<form class="form-horizontal" role="form" method="post" action="">
			<div class="tab-content tables">
					<div id="home" class="tab-pane fade in active">
						<div  class="ladoA ladoA2">
							<div class="col-md-12">
								<h4 class="text-center" style="font-weight:bold;color:#4F94CD">Colaborador</h4>
									<div class="form-group">
										<div class="col-sm-10 col-sm-offset-2">
											<input id="submit" name="submit" type="submit" value="Confirma" class="btn btn-primary" onclick="javascript:grava_registro('<?=$param;?>')">
										</div>
									</div>

									<div class="form-group">
										<label for="nome" class="col-sm-2 control-label">Nome</label>
										<div class="col-sm-10">
											<input type="text" required="required" class="form-control" id="nome" name="nome" placeholder="Nome Completo" value="<?php echo $nome ; ?>">
										</div>
									</div>

									<div class="form-group">
										<label for="razao" class="col-sm-2 control-label">Raz&atilde;o</label>
										<div class="col-sm-10">
											<input type="text" required="required" class="form-control" id="razao" name="razao" placeholder="Raz&atilde;o Completa" value="<?php echo $razao; ?>">
										</div>
									</div>					

									<div class="form-group">
										<label for="ende" class="col-sm-2 control-label">Endere&ccedil;o</label>
										<div class="col-sm-10">
											<input type="text" required="required" class="form-control" id="ende" name="ende" placeholder="Endere&ccedil;o completo" value="<?php echo $end; ?>">
										</div>
									</div>	

									<div class="form-group">
										<label for="complemento" class="col-sm-2 control-label">Compl.</label>
										<div class="col-sm-2">
											<input type="text" class="form-control" id="complemento" name="complemento" placeholder="" value="<?php echo $compl; ?>">
										</div>

										<label for="bairro" class="col-sm-2 control-label">Bairro</label>
										<div class="col-sm-6">
											<input type="text" required="required" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo $bairro; ?>">
										</div>
									</div>

									<div class="form-group">
										<label for="telefone" class="col-sm-2 control-label">Telefone(s)</label>
											<div class="col-sm-10">	
												<select  class="btn dropdown-toggle btn-default bootstrap-select" name="telefone" id="telefone" onchange="busca_telefones()">
												<?php
													$telefone = $conn->query( 
															   "SELECT tele_id, tele_tel, tele_contato, oper_id, pess_id
																FROM cada_telefones
																WHERE pess_id = $id
															   ");
													$contador = $telefone->rowCount();
													// percorre os resultados via iteração
													if ( $telefone and $contador>0) { 
														foreach($telefone as $rr)
														{	// exibe os resultados
															$tele_id 			= $rr["tele_id"];
															$tele_tel 			= $rr["tele_tel"];
															$tele_contato	= $rr["tele_contato"];
															$oper_id     	   = $rr["oper_id"];
														echo '<option value="'.$rr['tele_id'].'">'.$rr["tele_tel"]."</option>";
														}	
													} else {
															echo '<option value="0">'."Sem Registro"."</option>";
															$tele_contato ="Sem Registro";
															$tele_tel	  ="Sem Registro";	
													}	
												?>
													<option value="<?php echo $fone_id; ?>"><?php echo $tele_tel;?></option>
												</select>
											</div>	
									</div>					

									<div class="form-group">
										<label for="site" class="col-sm-2 control-label">site</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="site" name="site" placeholder="Site, URL" value="<?php echo $site; ?>">
										</div>
									</div>					

									<div class="form-group">
										<label for="email" class="col-sm-2 control-label">Email</label>
										<div class="col-sm-10">
											<input type="email" required="required" class="form-control" id="email" name="email" placeholder="exemplo@dominio.com" value="<?php echo $email; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
										</div>
									</div>
							</div>
						</div>

						<div class="ladoB ladoB1 ladoB2">
							<div class="col-md-12">
									<div class="form-group">
										<label for="data_r" class="col-sm-2 control-label">Data</label>
										<div class="col-sm-4">
											<input type="text" required="required" class="form-control" id="data_r" name="data_r" placeholder="Data de Registro" value="<?php echo date("d/m/Y", strtotime( $data_r )); ?>">
										</div>
									    <label for="pessoa" class="col-sm-2 control-label">Pessoa</label>
		<?php						if( $tp_pessoa=="F" ){  ?>
										<label class="radio-inline"><input type="radio" name="pessoa" checked onClick="javascript:label_pessoa('F')" value="F">f&iacute;sica</label>
										<label class="radio-inline"><input type="radio" name="pessoa" onClick="javascript:label_pessoa('J')" value="J">jur&iacute;dica</label>
		<?php						} elseif( $tp_pessoa=="J" ) { ?>
										<label class="radio-inline"><input type="radio" name="pessoa" onClick="javascript:label_pessoa('F')" value="F">f&iacute;sica</label>
										<label class="radio-inline"><input type="radio" name="pessoa" checked onClick="javascript:label_pessoa('J')" value="J">jur&iacute;dica</label>	
		<?php						} ?>	
									</div>	
									<br>
									<div class="form-group">
										<label id="doc1" for="cnpj" class="col-sm-2 control-label"><?=$label1?></label>
										<div class="col-sm-4">
											<input type="text" required="required" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" value="<?php echo $cnpj_cpf; ?>" onBlur="javascript:valida_campo_cnpj('<?php echo $cnpj; ?>')">
										</div>

										<label id="doc2" for="ie" class="col-sm-2 control-label"><?=$label2?></label>
										<div class="col-sm-4">
											<input type="text" required="required" class="form-control" id="ie" name="ie" placeholder="Inscri&ccedil;&atilde;o" value="<?php echo $insc_rg; ?>">
										</div>
									</div>

									<div class="form-group">
										<label for="estado" class="col-sm-2 control-label">Estado</label>
										<div class="col-sm-10">
											<select  class="btn dropdown-toggle btn-default bootstrap-select" name="estado" id="estado" onchange="busca_cidades()">
												<?php
													$estado = $conn->query( "SELECT e.esta_ibge, e.esta_uf, e.esta_nm, e.esta_aliq_icms
																			 FROM cada_estados AS e
																			 ORDER BY esta_nm
																			"); 
														foreach($estado as $row)
														{// exibe os resultados
															$esta_ibge 		  = $row["esta_ibge"];
															$esta_uf 			= $row["esta_uf"];
															$esta_nm 		  = $row["esta_nm"];
															$esta_aliq_icms= $row["esta_aliq_icms"];

															echo '<option value="'.$row["esta_ibge"].'">'.$row["esta_nm"]."</option>";
															if ( $row["esta_ibge"]==$id_esta_ibge ) { 
																 $e_ibge = $row["esta_ibge"]; 
																 $e_uf	  = $row["esta_uf"]; 
																 $e_nm   = $row["esta_nm"]; }
														}
													echo"<option  value=".$id_esta_ibge." selected=\"selected\">".$e_nm."</option>";	
												?>
											</select>	
										</div>
									</div>

									<div class="form-group">
										<label for="cidade" class="col-sm-2 control-label">Cidade</label>
										<div class="col-sm-10">
											<select name="cidade" id="cidade" class="btn dropdown-toggle btn-default bootstrap-select" disabled="true">
												<?php
													$cidade = $conn->query("
																			SELECT muni_ibge, muni_nm, esta_ibge  
																			FROM cada_municipios 
																			WHERE esta_ibge = $e_ibge
																			ORDER BY muni_nm
																		   "); 
														foreach($cidade as $r)
														{// exibe os resultados
															$muni_ibge 			= $r["muni_ibge"];
															$muni_nm 			= $r["muni_nm"];
															$estado_ibge		= $r["esta_ibge"];

														 echo '<option value="'.$r['muni_ibge'].'">'.$r['muni_nm'].'</option>';
														 if ( $muni_ibge == $id_muni_ibge ) { $m_nm = $muni_nm; }
														}
													echo"<option  value=$muni_ibge selected=\"selected\">". $m_nm ."</option>";	
												?>			
											</select>									
										</div>
									</div>					

									<div class="form-group">
										<label for="cep" class="col-sm-2 control-label">CEP</label>
										<div class="col-sm-4">
											<input type="text" required="required" class="form-control" id="cep" name="cep" placeholder="Cep" value="<?php echo $cep; ?>">
										</div>

										<label for="contato" class="col-sm-2 control-label">Contato</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="contato" name="contato" placeholder="contato" value="<?php echo $contato; ?>">
										</div>
									</div>

									<div class="form-group">
										<label for="obs" class="col-sm-2 control-label">Obs.</label>
										<div class="col-sm-10">
											<textarea class="form-control" rows="10" name="obs" style="height:80px; max-height:125px; min-height:80px; max-width:366px; min-width:366px;">
												<?php echo $pess_obs;?>
											</textarea>
										</div>
									</div>
							</div>

						</div>
					</div>	
                    <!----------------------------------------------------------------------------------------------------------------------------------------------------------->
					<div id="menu1" class="tab-pane fade">
						<div class="form-group">
							<label for="cep" class="col-sm-2 control-label">Modalidade</label>
							<div class="col-sm-4">
							<?php  
								if ( $pess_fun == 'TRUE' ) { ?> 								
									<input name="fun_pess" id="fun_pess" type="radio" class="btn-radio" value="False">&nbsp;Terceirizado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input name="fun_pess" id="fun_pess" type="radio" class="btn-radio" checked value="True">&nbsp;Funcion&aacute;rio<br><?php
								} else { ?>
									<input name="fun_pess" id="fun_pess" type="radio" class="btn-radio" checked value="True">&nbsp;Terceirizado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input name="fun_pess" id="fun_pess" type="radio" class="btn-radio" value="False">&nbsp;Funcion&aacute;rio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
							<?php	} ?>
							</div>
						</div>
					  </div>		
                    </div>	
			</form>
<?
} // final
?>