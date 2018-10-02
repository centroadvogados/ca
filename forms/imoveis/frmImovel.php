<?php
session_start();
    $param		= $_POST['param'];
    $registro 	= explode('|', $_POST['objeto']);	
    $modulo    = $_POST['modulo'];
			
		$prod_id 		 =	$registro[0];
		$prod_codgru 	 =  $registro[1]; 
		$prod_codmar     =	$registro[2];
		$prod_codigo 	 =	$registro[3];
		$prod_codori	 =	$registro[4];
		$prod_descricao  =	$registro[5];
		$prod_precov     =	$registro[6];
		$prod_marca	 	 =	$registro[7];
		$prod_precocusto =	$registro[8];
		$prod_tipo		 =  $registro[9];
		$prod_imagem     =	$registro[10];
		
		$prod_nomegru       = $registro[11];				
		$prod_dtentrada     = $registro[12]; 
		$prod_lote 		    = $registro[13];
		$prod_precoespecial = $registro[14]; 
		$prod_valorespecial = $registro[15];
		$prod_descradm      = $registro[16];
		$prod_endimovel		= $registro[17];	
		$prod_estimovel		= $registro[18];
		$prod_cidimovel		= $registro[19];
		
		$prod_imo_area_total		= $registro[20];
		$prod_imo_area_construida	= $registro[21];
		$prod_imo_dormitorio		= $registro[22];
		$prod_imo_suite 			= $registro[23];
		$prod_imo_cozinha			= $registro[24];
		$prod_imo_banheiro  		= $registro[25];
		$prod_imo_sala				= $registro[26];
		$prod_imo_vaga_garagem		= $registro[27];
		$prod_imo_id_obs			= $registro[28];
		$prod_imo_codcli			= $registro[29];
		$prod_imo_clie_dt_ul_compra	= $registro[30];	
		$prod_imo_clie_vl_ul_compra	= $registro[31];
		$prod_imo_pedi_codigo		= $registro[32];
		$prod_imo_esta_uf			= $registro[33];
		$prod_imo_esta_nome			= $registro[34];
		$prod_imo_muni_nm			= $registro[35];
		
		$prd_obs					= "Observação";
		$prod_iptu					= 0;
		$prod_pseguro				= 0;
		
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
				$type    	= $cfg['imoveis']['type'];
				$host    	= $cfg['imoveis']['host'];
				$user    	= $cfg['imoveis']['user'];
				$pass    	= $cfg['imoveis']['pass'];
				$name       = $cfg['imoveis']['name'];
				$port    	= $cfg['imoveis']['port'];
				$n1			= $cfg['nivel']['n1'];
                $n2			= $cfg['nivel']['n2'];
				$n3			= $cfg['nivel']['n3'];
				$n4			= $cfg['nivel']['n4'];
					
				$conn  			= new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);			
				$prod_imagem	= $cfg['local']['imagem'].'imoveis/'.$prod_imagem;	 		

				$prod_observacao = 	$conn->prepare("SELECT * FROM imoveis.cada_obs AS ob 
													WHERE ob.id_imoveis=$prod_id
													ORDER BY ob.id_obs
													"); 
																   
				$prod_observacao->execute();
					if ( $prod_observacao->rowCount() ) {
						// percorre os resultados via iteração
						foreach($prod_observacao as $row){				
							// exibe os resultados
							$prd_obs 		= $row["obbs"];
							$id_imoveis		= $row["id_imoveis"];
						}
					}
			
?>
	<script>
		function PrecoEspecial(v) {
			if ( v=='S' ) {
			  $att("#valorespecial").prop('disabled',false);	
			}  else if ( v=='N' ) {
			  $att("#valorespecial").prop('disabled',true);	
			}  
	    }
	</script>	
	
	<meta charset="utf-8">	
    <a href="javascript:fecha_registro(<?=$modulo;?>,3,0)"><img src="imgs/remove.png" alt="Fecha Janela" class="fecha_x direita" /></a>
	
	<ul class="nav nav-tabs nav-justified">
	  <li class="active"><a data-toggle="tab" href="#home"><b>Dados Gerais</b></a></li>
	  <li><a data-toggle="tab" href="#menu1"><b>Complementares</b></a></li>
	</ul>

<!-- inicio do formulario-->	
 	<form class="form-horizontal" role="form" method="post" action="">
	<div class="tab-content tables">
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<input id="submit" name="submit" type="submit" value="Confirma" class="btn btn-primary" onclick="javascript:grava_registro('<?=$param;?>')">
				</div>
			</div>
			<h4 class="text-center" style="font-weight:bold;color:#4F94CD">Produto</h4>
		    <div id="home" class="tab-pane fade in active">
				<div  class="ladoA ladoA2">
					<div class="col-md-12">
						
							<div class="form-group">
								<label for="grupo" class="col-sm-2 control-label">Grupo</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="grupo" name="grupo" placeholder="" value="<?php echo $prod_nomegru; ?>" disabled="true">
								</div>
							</div>

							<div class="form-group">
								<label for="codigo" class="col-sm-2 control-label">Codigo</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="codigo" name="codigo" placeholder="Codigo" value="<?php echo $prod_codigo; ?>" disabled="true">
								</div>
							</div>
							
							<div class="form-group">
								<label for="descricao" class="col-sm-2 control-label">Descri&ccedil;&atilde;o</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="descricao" name="descricao" placeholder="Descri&ccedil;&atilde;o Completa" value="<?php echo $prod_descricao; ?>" disabled="true">
								</div>
							</div>					
							
							<div class="form-group">
								<label for="categoria" class="col-sm-2 control-label">Categoria</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="categoria" name="categoria" placeholder="" value="<?=$prod_descradm; ?>" disabled="true">
								</div>
							</div>

							<div class="form-group">
								<label for="endimovel" class="col-sm-2 control-label">Endere&ccedil;o</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="endimovel" name="endimovel" value="<?=$prod_endimovel;?>" disabled="true">
								</div>
							</div>

							<div class="form-group">
								<label for="estimovel" class="col-sm-2 control-label">Estado</label>
								<div class="col-sm-3">
									<input type="text" required="required" class="form-control" id="estimovel" name="estimovel" value="<?=utf8_encode($prod_imo_esta_uf); ?>" disabled="true">
								</div>
							</div>
							
							<div class="form-group">
								<label for="cidimovel" class="col-sm-2 control-label">Cidade</label>
								<div class="col-sm-5">
									<input type="text" required="required" class="form-control" id="cidimovel" name="cidimovel" value="<?=utf8_encode($prod_imo_muni_nm); ?>" disabled="true">
								</div>
							</div>
							
							<div class="form-group">
								<label for="pvalor" class="col-sm-2 control-label">Valor</label>
								<div class="col-sm-4">
									<input type="text" required="required" class="form-control" id="pvalor" name="pvalor" placeholder="Valor" value="<?=moeda($prod_precov);?>" disabled="true">
								</div>
							</div>

							<div class="form-group">
								<label for="iptu" class="col-sm-2 control-label">IPTU</label>
								<div class="col-sm-4">
									<input type="text" required="required" class="form-control" id="iptu" name="iptu" placeholder="IPTU" value="<?=moeda($prod_iptu);?>" disabled="true">
								</div>
							</div>
								
					
					</div>
				</div>
			
				<div class="ladoB ladoB1 ladoB2" style="top:0px;">
					<div class="col-md-12">
					    <center><img class='' src=<?=$prod_imagem;?> heigth='260' width='260' border='0'></center>							
					</div>	
					
					<div class="form-group">
						<label for="pseguro" class="col-sm-4 control-label">Seguro Incêndio</label>
						<div class="col-sm-4">
							<input type="text" required="required" class="form-control" id="pseguro" name="pseguro" placeholder="Seguro" value="<?=moeda($prod_pseguro);?>" disabled="true">
						</div>
					</div>					
				</div>
				
			</div>	
				
			<div id="menu1" class="tab-pane fade">
				<div class="ladoA ladoA2">
						<div id="ladoA" style="margin-left:15px;">
							<div class="form-group">
								<label for="atotal" class="col-sm-4 control-label">&Aacute;rea Total</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="atotal" name="atotal" placeholder="Area Total" value="<?=$prod_imo_area_total.' m²'; ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="area" class="col-sm-4 control-label">&Aacute;rea Construida</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="area" name="area" placeholder="Area Construida" value="<?=$prod_imo_area_construida.' m²'; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label for="dorms" class="col-sm-3 control-label">Dormit&oacute;rio(s)</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="dorms" name="dorms" placeholder="Area Construida" value="<?=$prod_imo_dormitorio; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label for="suite" class="col-sm-4 control-label">Suite(s)</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="suite" name="suite" placeholder="Suites" value="<?=$prod_imo_suite; ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="cozin" class="col-sm-3 control-label">Cozinha(s)</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="cozin" name="cozin" placeholder="Cozinha" value="<?=$prod_imo_cozinha; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label for="banhe" class="col-sm-4 control-label">Banheiro(s)</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="banhe" name="banhe" placeholder="Banheiros" value="<?=$prod_imo_banheiro; ?>">
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="sala" class="col-sm-3 control-label">Sala(s)</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="sala" name="sala" placeholder="Salas" value="<?=$prod_imo_sala; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label for="garagem" class="col-sm-4 control-label">Vaga(s) Garagem</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="garagem" name="garagem" placeholder="Vagas Garagem" value="<?=$prod_imo_vaga_garagem; ?>">
								</div>
							</div>
					
							<div class="form-group">
								<div class="col-sm-12">Obs&emsp;
									<textarea class="form-control" rows="10" name="obs" style="height:80px; max-height:170px; min-height:80px; max-width:375px; min-width:375px;">
										<?=$prd_obs;?>
									</textarea>
								</div>
							</div>
                        </div> 							
			    </div>
				<div class="ladoB ladoB1 ladoB2" style="position:absolute; overflow: auto; width:385px;">

						<!-- Conexao a Base de Dados imoveis-->
						<?php
						$cons_imgaux = $conn->prepare("SELECT id_imgaux, img, id_imovel
													   FROM imoveis.cada_imgaux
													   WHERE id_imovel = :idimov	
													   ;");
		
						$cons_imgaux->bindParam( ':idimov', $prod_id, PDO::PARAM_INT ); 
			
			
						$cons_imgaux->execute();
						
						if ( $cons_imgaux->rowCount() ) {
							// percorre os resultados via iteração
							foreach($cons_imgaux as $row){				
							// exibe os resultados
							$img_id 	 = $row["id_imgaux"];
							$img_cada_img= $row["img"];
							$img_idpro	 = $row["id_imovel"];
							
							$caminhoaux	='imgs/imoveis/imgaux/';
							//----------------------------------------------------------------------
							?>
								<div class="col-md-12">
									<center><img class='' src=<?=$caminhoaux.$img_cada_img;?> heigth='200' width='200' border='0'></center>						
								</div>	
							<?php
							}
						} else {
							?><BR><BR><BR><BR>
								<div class="col-md-12">
									<center><img class='' src=<?='imgs/imoveis/casadraw2.jpg';?> heigth='300' width='300' border='0'></center>
									<center>IMAGENS NÃO DISPONIVEIS</center>
								</div>	
							<?php						
						}
						?>						
				</div>
			    
			</div>		

	</div>	

	</form>		
	
<?php
} else	{// se nao existir, lançara um erro
	throw new Exception("Arquivo de Configuracao Mysql.ini não encontrado");
}	
?>
