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
		$prod_nomegru    =	$registro[11];				
		$prod_dtentrada   = $registro[12]; 
		$prod_lote 		  = $registro[13];
		$prod_precoespecial = $registro[14]; 
		$prod_valorespecial = $registro[15];


		

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
		$type    	= $cfg['conexao']['type'];
		$host    	= $cfg['conexao']['host'];
		$user    	= $cfg['conexao']['user'];
		$pass    	= $cfg['conexao']['pass'];
		$name    	= $cfg['conexao']['name'];
		$port    	= $cfg['conexao']['port'];			
		$conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);			
		
		//----------- Produtos ----------------------------------------- 					
		if ( $prd = parse_ini_file("../../cfg.mobile/produtos.ini",true) ){
			$imagem		=	$prd['local']['imagem'];
		}
		if($prod_tipo==1){
			$produto=$imagem.'maquinas/';
			$modulo = 1;
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
    <a href="javascript:fecha_registro(3,<?=$modulo;?>,0)"><img src="imgs/btn_x_yellow.gif" alt="Fecha Janela" class="fecha_x direita" /></a>
	
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
						<h4 class="text-center" style="font-weight:bold;color:#4F94CD">Produto</h4>
							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<input id="submit" name="submit" type="submit" value="Confirma" class="btn btn-primary" onclick="javascript:grava_registro('<?=$param;?>')">
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
								<label for="marca" class="col-sm-2 control-label">Marca</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="marca" name="marca" placeholder="" value="<?php echo $prod_marca; ?>" disabled="true">
								</div>
							</div>
							
							<div class="form-group">
								<label for="grupo" class="col-sm-2 control-label">Grupo</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="grupo" name="grupo" placeholder="" value="<?php echo $prod_nomegru; ?>" disabled="true">
								</div>
							</div>

							<div class="form-group">
								<label for="precov" class="col-sm-2 control-label">Pre&ccedil;o</label>
								<div class="col-sm-6">
									<input type="text" required="required" class="form-control" id="precov" name="precov" placeholder="pre&ccedil;o venda" value="<?=moeda($prod_precov);?>">
								</div>
							</div>								
							
					</div>
				</div>
			
				<div class="ladoB ladoB1 ladoB2">
					<div class="col-md-12">
					    <center><img class='detalhe' src=<?=$produto.$prod_imagem;?> heigth='200' width='200' border='0'></center>						
					</div>	
				</div>
			</div>	
				
			<div id="menu1" class="tab-pane fade">
				<div class="ladoA ladoA2">
						<div id="ladoA" style="margin-left:15px;">
							<div class="form-group">
								<label for="Modelo" class="col-sm-2 control-label">Modelo</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo Produto" value="<?='Modelo' ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="Lote" class="col-sm-2 control-label">Lote</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="lote" name="lote" placeholder="Lote Produto" value="<?=$prod_lote;?>">
								</div>
							</div>
	
						    <div class="form-group">							
								<div class="col-sm-6"><h4>Preço Especial</h4>&emsp;</div>
                                <div class="col-sm-6">
									<label class="radio-inline"><input type="radio" name="precoespecial" checked onClick="javascript:PrecoEspecial('N')" value="N">Nao</label>
									<label class="radio-inline"><input type="radio" name="precoespecial" onClick="javascript:PrecoEspecial('S')" value="S">Sim</label>
	
								</div>
							</div>	

							<div class="form-group">
								<div class="col-sm-6">Pre&ccedil;o Venda
<?php							 	if( $prod_precoespecial=="N" ){  ?>
										<input type="text" required="required" class="form-control" id="valorespecial" name="valorespecial" placeholder="pre&ccedil;o venda" value="<?=moeda($prod_valorespecial);?>" disabled="true">
<?php								} elseif( $prod_precoespecial=="S" ) { ?>			
										<input type="text" required="required" class="form-control" id="valorespecial" name="valorespecial" placeholder="pre&ccedil;o venda" value="<?=moeda($prod_valorespecial);?>" disabled="false">
<?php								} ?>
								</div>							
							</div>	
	
							<BR>
							<div class="form-group">
								
								<div class="col-sm-12">Obs&emsp;
									<textarea class="form-control" rows="10" name="obs" style="height:80px; max-height:170px; min-height:80px; max-width:375px; min-width:375px;">
										<?php echo 'Campo Observação retirado da base de Dados Definida por variavel';?>
									</textarea>
								</div>
							</div>
                        </div> 							
			    </div>
			    
			</div>		

	</div>	
	</form>		
	
<?php
} else	{// se nao existir, lançara um erro
	throw new Exception("Arquivo de Configuracao Mysql.ini não encontrado");
}	
?>
