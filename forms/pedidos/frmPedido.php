<?php
session_start();
    $param		= $_POST['param'];
	$registro 	= explode('|', $_POST['objeto']);
	
		$pedi_id		 	= $registro[0];
		$pedi_id_tra 	 	= $registro[1];
		$pedi_id_ven	 	= $registro[2];		
		$pedi_id_cli 	 	= $registro[3];
		$pedi_codigo 	 	= $registro[4];
		$pedi_nm		 	= $registro[5];
		$pedi_flag		 	= $registro[6];
		$pedi_tp	     	= $registro[7];
		$pedi_base	 	 	= $registro[8];
		$pedi_valoricms  	= $registro[9];
		$pedi_valoripi   	= $registro[10];
		$pedi_valorfrete 	= $registro[11];
		$pedi_valorseguro	= $registro[12];
		$pedi_tnota		 	= $registro[13];
		$pedi_placa			= $registro[14];		
		$pedi_nrvolumes		= $registro[15];
		$pedi_especie		= $registro[16];  
		$pedi_pesol			= $registro[17];	
		$pedi_pesob			= $registro[18];  
		$pedi_dtemissao     = $registro[19];
		$pedi_dtcoleta		= $registro[20];  
		$pedi_dtsaida		= $registro[21];  
		$pedi_dtentrega		= $registro[22];
		$pedi_via			= $registro[23];
		$pedi_condvenda     = $registro[24];
		$pedi_formpag	    = $registro[25];
		$pedi_nrnf			= $registro[26];			    
		$pedi_nfemitida		= $registro[27]; 
		$pedi_desconto      = $registro[28];
		$pedi_descsobre     = $registro[29];
		$pedi_confirmado    = $registro[30];
		$pedi_imp    		= $registro[31];
		$pedi_impboleto     = $registro[32];
		$pedi_impdup		= $registro[33];
		$pedi_obs1			= $registro[34];
		$pedi_obs2			= $registro[35];
		$pedi_marcado		= $registro[36];
		$pedi_esta_ibge_or	= $registro[37];
		$pedi_esta_ibge_dn	= $registro[38];
		$pedi_muni_ibge_or	= $registro[39];
		$pedi_muni_ibge_dn	= $registro[40];
		$pedi_id_rem		= $registro[41];
		$pedi_id_des		= $registro[41];
		$pedi_fun_id		= $registro[43];
		$pedi_tra_id		= $registro[44];
		$pedi_obs			= $registro[45];
		$pedi_arquivo		= $registro[46];
        $pedi_email      	= $registro[47];
		
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
?>

    <a href="javascript:fecha_registro('<?=$param;?>')"><img src="imgs/btn_x_yellow.gif" alt="Fecha Janela" class="fecha_x direita" /></a>
	
	<ul class="nav nav-tabs nav-justified">
	  <li class="active"><a data-toggle="tab" href="#home"><b><h4  style="font-weight:bold; color:#ccc">Pedido - Dados Gerais</h4></b></a></li>
	  <li><a data-toggle="tab" href="#menu1"><b><h4  style="font-weight:bold; color:#ccc">Produtos</h4></b></a></li>
	</ul>
<!-- inicio do formulario-->	
 	<form class="form-horizontal" role="form" method="post" action="">
	<div class="tab-content tables">
		
		    <div id="home" class="tab-pane fade in active">
				<div  class="ladoA ladoA2">
					<div class="col-md-12">
						<h3 class="page-header text-center" style="font-weight:bold; color:#4F94CD"><?=$pedi_codigo;?></h3>
							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<input id="submit" name="submit" type="submit" value="Confirma" class="btn btn-primary" onclick="javascript:grava_registro('<?=$param;?>')">
								</div>
							</div>
						
							<div class="form-group">
								<label for="pedi_nm" class="col-sm-2 control-label">Cliente</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="pedi_nm" name="pedi_nm" placeholder="Nome do Cliente" value="<?=utf8_encode( $pedi_nm); ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="pedi_end" class="col-sm-2 control-label">Endereço</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="pedi_end" name="pedi_end" placeholder="Endereco" value="Endereco Entrega estipulado pelo CLiente">
								</div>
							</div>

							<div class="form-group">
								<label for="pedi_usu" class="col-sm-2 control-label">Usuario</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="pedi_usu" name="pedi_usu" placeholder="Usuario" value="<?=$pedi_email; ?>">
								</div>
							</div>


					</div>
				</div>

				<div class="ladoB ladoB1 ladoB2">
					<div class="col-md-12">
							<div class="form-group">
								<label for="pedi_contato" class="col-sm-2 control-label">Contato</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="pedi_contato" name="pedi_contato" placeholder="Contato" value="Nome do Contato do Pedido">
								</div>
							</div>
					</div>

					<div class="col-md-12">
							<div class="form-group">
								<label for="pedi_cidade" class="col-sm-2 control-label">Cidade</label>
								<div class="col-sm-6">
									<input type="text" required="required" class="form-control" id="pedi_cidade" name="pedi_cidade" placeholder="Cidade" value="Cidade">
								</div>
							</div>
					        <div class="form-group">
								<label for="pedi_estado" class="col-sm-2 control-label">Estado</label>
								<div class="col-sm-2">
									<input type="text" required="required" class="form-control" id="pedi_estado" name="pedi_estado" placeholder="Estado" value="Estado">
								</div>
							</div>

					</div>					
				</div>				

			</div>	
				
			<div id="menu1" class="tab-pane fade"><!--menu1-->
				<div class="col-lg-12">
					<h4 class="modal-title" style="font-weight:bola; color:#000">Produtos</h4>					
					<div id="produtos"> 			
						<table class="table-striped table-bordered table-hover table"><!-- pedidos.css-->
							
								<thead>
									<tr>
										<th><center>C&Oacute;DIGO</center></th>
										<th><center>QTDE</center></th>
										<th class='de600'><center>PRODUTO &emsp;<a href="javascript:carga()"><img width='15' src='imgs/icone/plus.png'></a></center></th>										
										<th class='de600'><center>PRE&Ccedil;O</center></th>
										<th><center>PRE&Ccedil;O TOTAL</center></th>
										<th class='ate900'><center>IMG</center></th>
									</tr>
								</thead>
					
								<?php
								if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){
									//----------- Conexao a Base de Dados--------------------------------------------------------------------------		
									$conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
									$consulta = $conn->prepare("SELECT
																	codpro, pedi_id, codigo, descricao, 
																	coddis, codgru, codori, codven, codmar, 
																	precov, imagem, quantidade, tipo
																FROM cada_material
																WHERE pedi_id=$pedi_id
																ORDER BY codigo, descricao, codpro, pedi_id DESC 
															  ");
									$consulta->execute();
							
									if ( $consulta->rowCount() )  {
										// percorre os resultados via iteração
										foreach($consulta as $row){				
											// exibe os resultados
											$mat_codpro 			= $row["codpro"];
											$mat_pedi_id			= $row["pedi_id"];
											$mat_codigo				= $row["codigo"];
											$mat_descricao	 		= $row["descricao"];
											$mat_coddis				= $row["coddis"];
											$mat_codgru 			= $row["codgru"];
											$mat_codori 			= $row["codori"];
											$mat_codven				= $row["codven"];
											$mat_codmar				= $row["codmar"];
											$mat_precov				= $row["precov"];
											$mat_imagem				= $row["imagem"];
											$mat_quanti				= $row["quantidade"];
											$mat_tipo				= $row["tipo"];
											
											if($mat_tipo==0){
												$caminho='imgs/portal/';
											} else if($mat_tipo==1) {
												$caminho='imgs/maquinas/';
											}

																								
//-------------------------------------------------------------------------------------------------------------------------------------													?>
								<tr>
									<td><a href="javascript:abre_produto('<?=$mat_codpro;?>','<?=$objretorno;?>','<?=$param;?>')">
										<center><?=$mat_codigo;?></center></a>
									</td>
									<td><center><?=$mat_quanti;?></center></td>
									<td class='de600'>
										<center><?=utf8_encode(substr($mat_descricao,0,40));?></center>
									</td>
									
									<td class='de600'><center><?=moeda($mat_precov);?></center></td>
									<td><center><?=moeda($mat_precov*$mat_quanti);?></center></td>
									<td class='ate900'><center><img class='' src=<?=$caminho.$mat_imagem;?> heigth='20' width='20' border='0'></center></td>
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
<?php
	} else	{// se nao existir, lançara um erro
	throw new Exception("Arquivo de Configuracao config.ini não encontrado");
}	
?>