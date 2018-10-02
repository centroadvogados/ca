<?php
session_start();
    $param=$_POST['param'];
	$registro 	= explode('|', $_POST['objeto']);

		$id			 = $registro[0];
		$razao       = $registro[1]; 
		$nome 		 = $registro[2];
		$ende		 = $registro[3];
		$complemento = $registro[5];
		$bairro      = $registro[6];
		$cep         = $registro[7];
		$fone_id	 = $registro[8];
		$cnpj		 = $registro[10];
		$ie          = $registro[11];
		$data_r      = $registro[12];
		$contato     = $registro[13];
		$site		 = $registro[14];
		$email 		 = $registro[15];
		$tp_pessoa   = $registro[17];
		$estado_id   = $registro[19];
		$cidade_id   = $registro[20];
		$pess_senha  = $registro[21];	
		$pess_cli	 = $registro[22];		 
		$pess_for	 = $registro[23];
		$pess_usu	 = $registro[24];				
		$pess_ven	 = $registro[25];		 		
		$pess_fun    = $registro[26];
		$obs 	     = $registro[27];
        $esta_nm	 = $registro[28];
        $esta_uf	 = $registro[29];			 
		$muni_nm     = $registro[30];
													

if ($tp_pessoa=='F'){ $label1='CPF'; $label2='RG';} else { $label1='CNPJ'; $label2='IE';}
		
function __autoload($classe){
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
		$user    	= $cfg['conexao']['user'];
		$pass       = $cfg['conexao']['pass'];
		$name       = $cfg['conexao']['name'];
		$port    	= $cfg['conexao']['port'];			
		$conn  	    = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);			
?>
    <a href="javascript:fecha_registro()"><img src="imgs/remove.png" alt="Fecha Janela" class="fecha_x direita" /></a>
    	
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
						<h4 class="text-center" style="font-weight:bold;color:#4F94CD">Cadastro</h4>
							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<input id="submit" name="submit" type="submit" value="Confirma" class="btn btn-primary" onclick="javascript:grava_registro('<?=$param;?>')">
								</div>
							</div>
						
							<div class="form-group">
								<label for="nome" class="col-sm-2 control-label">Nome</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="nome" name="nome" placeholder="Nome Completo" value="<?=$nome;?>">
								</div>
							</div>

							<div class="form-group">
								<label for="razao" class="col-sm-2 control-label">Raz&atilde;o</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="razao" name="razao" placeholder="Raz&atilde;o Completa" value="<?=$razao; ?>">
								</div>
							</div>					
							
							<div class="form-group">
								<label for="ende" class="col-sm-2 control-label">Endere&ccedil;o</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="ende" name="ende" placeholder="Endere&ccedil;o completo" value="<?=$ende; ?>">
									
								</div>
							</div>	

							<div class="form-group">
								<label for="complemento" class="col-sm-2 control-label">Compl.</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="complemento" name="complemento" placeholder="" value="<?=$complemento; ?>">
									
								</div>
							
								<label for="bairro" class="col-sm-2 control-label">Bairro</label>
								<div class="col-sm-6">
									<input type="text" required="required" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?= $bairro; ?>">
									
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
												{							
													// exibe os resultados
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
											<option value="<?= $fone_id; ?>"><?= $tele_tel;?></option>
										</select>
									</div>	
							</div>					
							
							<div class="form-group">
								<label for="site" class="col-sm-2 control-label">site</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="site" name="site" placeholder="Site, URL" value="<?= $site; ?>">
								</div>
							</div>					
							
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email" required="required" class="form-control" id="email" name="email" placeholder="exemplo@dominio.com" value="<?= $email; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
								</div>
							</div>
					</div>
				</div>
			
				<div class="ladoB ladoB1 ladoB2">
					<div class="col-md-12">
					        <div class="form-group">
								<label for="data_r" class="col-sm-2 control-label">Data</label>
								<div class="col-sm-4">
									<input type="text" required="required" class="form-control" id="data_r" name="data_r" placeholder="Data de Registro" value="<?= date("d/m/Y", strtotime( $data_r )); ?>">
									
								</div>
							</div>	
							<br>
							
					        <div class="form-group">							
								    <div class="col-sm-12">
<?php								if( $tp_pessoa=="F" ){  ?>
										<label class="radio-inline"><input type="radio" name="pessoa" checked onClick="javascript:label_pessoa('F')" value="F">f&iacute;sica</label>
										<label class="radio-inline"><input type="radio" name="pessoa" onClick="javascript:label_pessoa('J')" value="J">jur&iacute;dica</label>
<?php								} elseif( $tp_pessoa=="J" ) { ?>
										<label class="radio-inline"><input type="radio" name="pessoa" onClick="javascript:label_pessoa('F')" value="F">f&iacute;sica</label>
										<label class="radio-inline"><input type="radio" name="pessoa" checked onClick="javascript:label_pessoa('J')" value="J">jur&iacute;dica</label>	
<?php								} ?>	
									</div>
							</div>	
							<br>

							<div class="form-group">
								<label id="doc1" for="cnpj" class="col-sm-2 control-label"><?=$label1?></label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" value="<?= $cnpj; ?>" onBlur="javascript:valida_campo_cnpj('<?= $cnpj; ?>')">
								</div>
	
						
								<label id="doc2" for="ie" class="col-sm-2 control-label"><?=$label2?></label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="ie" name="ie" placeholder="Inscri&ccedil;&atilde;o" value="<?= $ie; ?>">
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
													$esta_ibge 			= $row["esta_ibge"];
													$esta_uf 			= $row["esta_uf"];
													$esta_nm 			= $row["esta_nm"];
													$esta_aliq_icms		= $row["esta_aliq_icms"];
												
													echo '<option value="'.$row["esta_ibge"].'">'.$row["esta_nm"]."</option>";
													if ($row["esta_ibge"]==$estado_id) { 
														$e_ibge=$row["esta_ibge"]; $e_uf=$row["esta_uf"]; $e_nm=$row["esta_nm"]; }
												}
											echo"<option  value=".$estado_id." selected=\"selected\">".$e_nm."</option>";	
										?>
									</select>	
								</div>
							</div>
							
							<div class="form-group">
								<label for="cidade" class="col-sm-2 control-label">Cidade</label>
								<div class="col-sm-10">
									<select name="cidade" id="cidade" class="btn dropdown-toggle btn-default bootstrap-select" disabled="true">
										<?php
											$cidade = $conn->query("SELECT muni_ibge, muni_nm, esta_ibge  
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
												 if ( $muni_ibge == $cidade_id) { $m_nm = $muni_nm; }
												}
											echo"<option  value=$muni_ibge selected=\"selected\">". $m_nm ."</option>";	
										?>			
									</select>									
								</div>
							</div>					
							
							
							<div class="form-group">
								<label for="cep" class="col-sm-2 control-label">CEP</label>
								<div class="col-sm-4">
									<input type="text" required="required" class="form-control" id="cep" name="cep" placeholder="Cep" value="<?= $cep; ?>">
								</div>
												
								<label for="contato" class="col-sm-2 control-label">Contato</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="contato" name="contato" placeholder="contato" value="<?= $contato; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label for="obs" class="col-sm-2 control-label">Obs.</label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="10" name="obs" style="height:80px; max-height:125px; min-height:80px; max-width:295px; min-width:295px;">
										<?= $obs;?>
									</textarea>
								</div>
							</div>
					</div>
					
				</div>
			</div>	
				
			<div id="menu1" class="tab-pane fade">
			    <div  class="ladoA ladoA2">
					<div class="form-group">
						<label for="fun_pess" class="col-sm-4 control-label">Contratação</label>
						<div class="col-sm-8">
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
					
					<div class="form-group">
						<div class="col-sm-10">&emsp;&emsp;&emsp;&emsp;Cliente&emsp;&emsp;&emsp;&nbsp;
							<?php  
							if ( $pess_cli == 'TRUE' ) { ?> 								
								<input name="cli_pess" id="cli_pess" type="radio" class="btn-radio" value="False">&emsp;Nao&emsp;&emsp;
								<input name="cli_pess" id="cli_pess" type="radio" class="btn-radio" checked value="True">&emsp;Sim&emsp;&emsp;<br><?php
							} else { ?>
								<input name="cli_pess" id="cli_pess" type="radio" class="btn-radio" checked value="True">&emsp;Nao&emsp;&emsp;
								<input name="cli_pess" id="cli_pess" type="radio" class="btn-radio" value="False">&emsp;Sim&emsp;&emsp;<br>
							<?php	} ?>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">&emsp;&emsp;&emsp;&emsp;Vendedor&emsp;&emsp;&nbsp;
							<?php  
							if ( $pess_ven == 'TRUE' ) { ?> 								
								<input name="ven_pess" id="ven_pess" type="radio" class="btn-radio" value="False">&emsp;Nao&emsp;&emsp;
								<input name="ven_pess" id="ven_pess" type="radio" class="btn-radio" checked value="True">&emsp;Sim&emsp;&emsp;<br><?php
							} else { ?>
								<input name="ven_pess" id="ven_pess" type="radio" class="btn-radio" checked value="True">&emsp;Nao&emsp;&emsp;
								<input name="ven_pess" id="ven_pess" type="radio" class="btn-radio" value="False">&emsp;Sim&emsp;&emsp;<br>
							<?php	} ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10">&emsp;&emsp;&emsp;&emsp;Fornecedor&emsp;&nbsp;
							<?php  
							if ( $pess_for == 'TRUE' ) { ?> 								
								<input name="for_pess" id="for_pess" type="radio" class="btn-radio" value="False">&emsp;Nao&emsp;&emsp;
								<input name="for_pess" id="for_pess" type="radio" class="btn-radio" checked value="True">&emsp;Sim&emsp;&emsp;<br><?php
							} else { ?>
								<input name="for_pess" id="for_pess" type="radio" class="btn-radio" checked value="True">&emsp;Nao&emsp;&emsp;
								<input name="for_pess" id="for_pess" type="radio" class="btn-radio" value="False">&emsp;Sim&emsp;&emsp;<br>
							<?php	} ?>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">&emsp;&emsp;&emsp;&emsp;Usuario&emsp;&emsp;&emsp;
							<?php  
							if ( $pess_usu == 'TRUE' ) { ?> 								
								<input name="usu_pess" id="usu_pess" type="radio" class="btn-radio" value="False">&emsp;Nao&emsp;&emsp;
								<input name="usu_pess" id="usu_pess" type="radio" class="btn-radio" checked value="True">&emsp;Sim&emsp;&emsp;<br><?php
							} else { ?>
								<input name="usu_pess" id="usu_pess" type="radio" class="btn-radio" checked value="True">&emsp;Nao&emsp;&emsp;
								<input name="usu_pess" id="usu_pess" type="radio" class="btn-radio" value="False">&emsp;Sim&emsp;&emsp;<br>
							<?php	} ?>
						</div>
					</div>					



					
				</div>
				<div class="ladoB ladoB1 ladoB2">Lado B
				</div>
			</div>		

	</div>	
	</form>
<?php
} else	{// se nao existir, lançara um erro
	throw new Exception("Arquivo de Configuracao Mysql.ini não encontrado");
}	
?>