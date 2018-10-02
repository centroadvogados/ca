<?php
session_start();
    $param		= $_POST['param'];
	$registro 	= explode('|', $_POST['objeto']);
	
		$proc_id		 	= $registro[0];
		$proc_documento  	= $registro[1];
		$proc_assunto	 	= $registro[2];		
		$proc_desc 		 	= $registro[3];
		$proc_data	 	 	= $registro[4];
		$proc_alteradopor 	= $registro[5];
		$proc_alteradoem 	= $registro[6];
		$proc_caixa	     	= $registro[7];
		$proc_setorarquivado= $registro[8];
		$proc_pess_id  		= $registro[9];
		$proc_pess_nm		= $registro[10];
		$proc_pess_apld		= $registro[11];
		$proc_pess_end 		= $registro[12];
		$proc_pess_end_nr	= $registro[13];
		$proc_pess_compl	= $registro[14];
		$proc_pess_bairro	= $registro[15];
		$proc_pess_cep		= $registro[16];
		$proc_pess_tel		= $registro[17];
		$proc_pess_fax		= $registro[18];
		$proc_pess_cnpj_cpf	= $registro[19];
		$proc_pess_insc_rg 	= $registro[20];
		$proc_pess_dt_aber_nasc= $registro[21];
		$proc_pess_contato 	= $registro[22];
		$proc_pess_site		= $registro[23];
		$proc_pess_email	= $registro[24];
		$proc_pess_dt_inc	= $registro[25];
		$proc_pess_tp_pessoa= $registro[26];
		$proc_pess_delete	= $registro[27];
		$proc_esta_ibge		= $registro[28];
		$proc_muni_ibge		= $registro[29];
		$proc_pess_senha	= $registro[30];
		$proc_pess_cli		= $registro[31];
		$proc_pess_for		= $registro[32];
		$proc_pess_usu 		= $registro[33];
		$proc_pess_ven		= $registro[34];
		$proc_pess_fun		= $registro[35];
		$proc_pess_obs		= $registro[36];
		$proc_tipo_id 		= $registro[37];
		$proc_tipo_descr    = $registro[38];

		
function __autoload($classe){
				$pastas = array('../../classes/conexao');
					foreach ($pastas as $pasta)	{
						if (file_exists("{$pasta}/{$classe}.class.php"))
						{
							include_once "{$pasta}/{$classe}.class.php";
						}
					}
}

include_once ('../../funcoes/funcoes.php');		
			
if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){
		$type  	= $cfg['conexao']['type'];
		$host  	= $cfg['conexao']['host'];
		$user  	= $cfg['conexao']['user'];
		$pass  	= $cfg['conexao']['pass'];
		$name  	= $cfg['conexao']['name'];
		$port  	= $cfg['conexao']['port'];			
		$n1		= $cfg['nivel']['n1'];
        $n2		= $cfg['nivel']['n2'];
		$n3		= $cfg['nivel']['n3'];
		$n4		= $cfg['nivel']['n4'];

		$conn  	= new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);		
		
		//----------- Produtos ---------------------------------					
		if ( $prd 		= parse_ini_file("../../cfg.mobile/produtos.ini",true) ){
			 $imagem    = $prd['local']['imagem'];
		}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt">

    <!--<a href="javascript:fecha_registro('<?=$param;?>')"><img src="imgs/btn_x_yellow.gif" alt="Fecha Janela" class="fecha_x direita" /></a>-->
	<a href="javascript:fecha_registro('<?=$param;?>')"><img src="imgs/remove.png" alt="Fecha Janela" class="fecha_x direita" /></a>
	<ul class="nav nav-tabs nav-justified">
	  <li class="active"><a data-toggle="tab" href="#home"><b><h4  style="font-weight:bold; color:#ccc">Processo - Dados Gerais</h4></b></a></li>
	  <li><a data-toggle="tab" href="#menu1"><b><h4  style="font-weight:bold; color:#ccc">Andamentos</h4></b></a></li>
	</ul>
<!-- inicio do formulario-->	
 	<form class="" role="form" method="post" action="">
	<div class="tab-content tables">
	
			<h3 class="page-header text-center" style="font-weight:bold; color:#4F94CD"><?=$proc_documento;?>&emsp;&emsp;
				<?=utf8_encode( $proc_tipo_descr ); ?>&emsp;&emsp;
				<input id="submit" name="submit" type="submit" value="Confirma" class="btn btn-primary" onclick="javascript:grava_registro('<?=$param;?>')">
			</h3>
			
						
		    <div id="home" class="tab-pane fade in active" style="height:360px;">
				<div  class="ladoA ladoA2" style="height:360px;">
					<div class="col-md-12">
							<div class="form-group">
								<label for="proc_reqte" class="col-sm-2 control-label">Reqte</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="proc_reqte" name="proc_reqte" placeholder="Nome do Requerente" value="<?=utf8_encode( $proc_pess_nm); ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="proc_end" class="col-sm-2 control-label">Endereço</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="proc_end1" name="proc_end1" placeholder="Endereco" value="<?=utf8_encode( $proc_pess_end ); ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="proc_bai" class="col-sm-10">Bairro / Cidade</label>
								<div class="col-sm-6">
									<input type="text" required="required" class="form-control" id="proc_bai1" name="proc_bai1" placeholder="Bairro" value="<?=$proc_pess_bairro; ?>">
								</div>
								<div class="col-sm-6">
									<input type="text" required="required" class="form-control" id="proc_cidade1" name="proc_cidade1" placeholder="Cidade" value="Cidade">
								</div>
							</div>

							<div class="form-group">
								<label for="proc_fone" class="col-sm-10">telefone / e-mail</label>
								<div class="col-sm-4">
									<input type="text" required="required" class="form-control" id="proc_fone1" name="proc_fone1" placeholder="Fone" value="<?=$proc_pess_tel; ?>">
								</div>
								<div class="col-sm-8">
									<input type="text" required="required" class="form-control" id="proc_email1" name="proc_email1" placeholder="Email" value="<?=$proc_pess_email; ?>">
								</div>
							</div>
					</div>
				</div>

				<div class="ladoB ladoB1 ladoB2" style="position:absolute; top: 135px; height:360px;">
					<div class="col-md-12">
							<div class="form-group">
								<label for="proc_reqdo" class="col-sm-2 control-label">Reqdo</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="proc_reqdo" name="proc_reqdo" placeholder="reqdo" value="Nome do Requerido">
								</div>
							</div>
					
							<div class="form-group">
								<label for="proc_end2" class="col-sm-2 control-label">Endereço</label>
								<div class="col-sm-8">
									<input type="text" required="required" class="form-control" id="proc_end2" name="proc_end2" placeholder="Endereco2" value="<?=utf8_encode( '2' ); ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="proc_bai2" class="col-sm-10">Bairro / Cidade</label>
								<div class="col-sm-6">
									<input type="text" required="required" class="form-control" id="proc_bai2" name="proc_bai2" placeholder="Bairro2" value="<?='2'; ?>">
								</div>
								<div class="col-sm-6">
									<input type="text" required="required" class="form-control" id="proc_cidade2" name="proc_cidade2" placeholder="Cidade2" value="Cidade2">
								</div>
							</div>

							<div class="form-group">
								<label for="proc_fone2" class="col-sm-10">telefone / e-mail</label>
								<div class="col-sm-4">
									<input type="text" required="required" class="form-control" id="proc_fone2" name="proc_fone2" placeholder="Fone2" value="<?='2'; ?>">
								</div>
								<div class="col-sm-8">
									<input type="text" required="required" class="form-control" id="proc_email2" name="proc_email2" placeholder="Email2" value="<?='2'; ?>">
								</div>	
							</div>
					</div>
				</div>	    
			</div>	
				
			<div id="menu1" class="tab-pane fade"><!--menu1-->
				<div class="col-lg-12">
								
					<div id="andamentos"> 			
						<table class="table-striped table-bordered table-hover table"><!-- pedidos.css-->
							
							<thead>
								<tr>
									<th><center>ORIGEM &emsp;</center></th>
									<th class='de600'><center>DESTINO &emsp;</center></th>										
			     					<th class='de600'><center>ENVIADO EM</center></th>
									<th class='de600'><center>ENVIADO POR</center></th>
									<th class='ate900'><center>RECEBIDO EM</center></th>
									<th class='ate900'><center>RECEBIDO POR</center></th>
								</tr>
							</thead>
					
							<?php
							if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){
								//----------- Conexao a Base de Dados--------------------------------------------------------------------------		
								$conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
								$consulta = $conn->prepare("
											SELECT
												pe.perc_nu_id, pe.perc_nu_volume, pe.perc_nu_de, pe.perc_nu_de_tipo,
												pe.perc_nu_para, pe.perc_nu_para_tipo, pe.perc_dt_data, pe.perc_li_enviado,
												pe.perc_dt_aceite, pe.perc_nu_login, pe.perc_st_desc, pe.perc_st_relacao,
												pe.perc_li_arquivado, pe.perc_nu_aceitopor, pe.perc_proc_id,
												fi.cust_nu_id, fi.cust_nu_custo, fi.cust_st_sigla, fi.cust_st_desc, 													
												fi.cust_li_tipo, fi.cust_nu_alteradopor, fi.cust_dt_alteradoem,
												lo.login_nu_custo, lo.login_nu_registro, lo.login_st_usuario,lo.login_st_senha, 
												lo.login_dt_alteradoem, lo.login_nu_alteradopor, lo.login_li_status																						
											FROM protocolo3.prot_percursos AS pe
											INNER JOIN  protocolo3.fi01_custos AS fi ON fi.cust_nu_id=pe.perc_nu_de
											INNER JOIN  protocolo3.us01_login AS lo  ON lo.login_nu_registro=pe.perc_nu_login
											WHERE pe.perc_proc_id=$proc_id
											ORDER BY pe.perc_nu_id DESC
												
								");
								$consulta->execute();
							
								if ( $consulta->rowCount() )  {
									// percorre os resultados via iteração
									foreach($consulta as $row){				
										// exibe os resultados
										$perc_nu_id 		 	 = $row["perc_nu_id"];
										$perc_nu_volume			 = $row["perc_nu_volume"];
										$perc_nu_de				 = $row["perc_nu_de"];
										$perc_nu_de_tipo	 	 = $row["perc_nu_de_tipo"];
										$perc_nu_para			 = $row["perc_nu_para"];											
										$perc_nu_para_tipo 		 = $row["perc_nu_para_tipo"];
										$perc_dt_data 			 = $row["perc_dt_data"];
										$perc_li_enviado		 = $row["perc_li_enviado"];
										$perc_dt_aceite			 = $row["perc_dt_aceite"];
										$perc_nu_login			 = $row["perc_nu_login"];
										$perc_origem			 = $row["cust_st_desc"];
										$perc_st_relacao		 = $row["perc_st_relacao"];
										$perc_li_arquivado		 = $row["perc_li_arquivado"];
										$perc_nu_aceitopor		 = $row["perc_nu_aceitopor"];
									    $perc_proc_id			 = $row["perc_proc_id"];
										$perc_cust_nu_id		 = $row["cust_nu_id"];											
										$perc_cust_nu_custo		 = $row["cust_nu_custo"];
										$perc_cust_st_sigla		 = $row["cust_st_sigla"];
										$perc_cust_st_desc		 = $row["cust_st_desc"];
										$perc_cust_li_tipo		 = $row["cust_li_tipo"];
										$perc_cust_nu_alteradopor= $row["cust_nu_alteradopor"];
										$perc_cust_dt_alteradoem = $row["cust_dt_alteradoem"];
										$perc_login_st_usuario	 = $row["login_st_usuario"];
									
										$destino = $conn->prepare("
											SELECT
												de.cust_nu_id, de.cust_nu_custo, de.cust_st_sigla, de.cust_st_desc, 													
												de.cust_li_tipo, de.cust_nu_alteradopor, de.cust_dt_alteradoem,
												us.login_nu_custo, us.login_nu_registro, us.login_st_usuario, us.login_li_status
											FROM protocolo3.fi01_custos AS de
											INNER JOIN  protocolo3.us01_login AS us ON us.login_nu_registro=$perc_nu_aceitopor
											WHERE de.cust_nu_id=$perc_nu_para						
										");
										$destino->execute();
							
										if ( $destino->rowCount() )  {
											// percorre os resultados via iteração
											foreach($destino as $row){				
												// exibe os resultados
												$perc_destino 	  		= $row["cust_st_desc"];
												$perc_st_recebidopor 	= $row["login_st_usuario"];
											}
										}	
								//----------------------------------------------------------------													
							?>
										<tr>
											<td><center><?=$perc_origem;?></center></td>
											<td><center><?=$perc_destino;?></center></td>
											<td class='de600'><?=$perc_dt_data;?><center></center>
											</td>
											
											<td class='de600'><?=$perc_login_st_usuario;?><center></center></td>
											<td><center><?=$perc_dt_aceite; ?></center></td>
											<td class='ate900'><center><?=$perc_st_recebidopor; ?></center></td>
										</tr>
							<?php	
									}
								}
							} 							
											
							?>				
						</table>
					</div>
				</div>
			</div><!---menu1-->												

	</div>	
	</form>
	</html>
<?php
	} else	{// se nao existir, lançara um erro
	throw new Exception("Arquivo de Configuracao config.ini não encontrado");
}	
?>