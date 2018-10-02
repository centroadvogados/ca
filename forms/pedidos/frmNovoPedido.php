<?php
session_start();
    $param  =$_POST['param'];
		
function __autoload($classe){
	$pastas = array('../../classes/conexao');
	foreach ($pastas as $pasta)	{
		if (file_exists("{$pasta}/{$classe}.class.php"))
			{
				include_once "{$pasta}/{$classe}.class.php";
			}
	}
}

function moeda($numero) { 
    $numero = number_format($numero, 2, ',', '.'); 
    return $numero; 
} 

if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){
		$type  		= $cfg['conexao']['type'];
		$host  		= $cfg['conexao']['host'];
		$user  		= $cfg['conexao']['user'];
		$pass  		= $cfg['conexao']['pass'];
		$name  		= $cfg['conexao']['name'];
		$port  		= $cfg['conexao']['port'];
		$acronomo  	= $cfg['descricao']['nome'];
		$conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);			
		
		//----------- Produtos ----------------------------------------- 					
		if ( $prd = parse_ini_file("../../cfg.mobile/produtos.ini",true) ){
			 $imagem   	= $prd['local']['imagem'];
			 $nivel2   	= $prd['local']['nivel2'];
		}
		
		$data       =   explode("-",date('d-m-y'));
		$hora       =   explode(":",date('H:i:s'));
		$dt	        =   $data[2].$data[1].$data[0];
		$hr	        =   $hora[0].$hora[1].$hora[2];
	    $dt_registro=  $data[0]."/".$data[1]."/".$data[2]." - ".$hora[0].":".$hora[1].":".$hora[2];
		
		$pedi_codigo= $acronomo.$param.$dt.$hr;
	    $pedi_nf_chave	  = '';
		$pedi_id	 	  = '';
		$pedi_id_cli 	  = '';
		$pedi_nm_cli	  = '';
		$pedi_id_tra 	  = '';
		$pedi_id_ven	  = '';
        $pedi_id_reme     = ''; 
		$pedi_remetente   = '';
		$pedi_id_dest     = ''; 
		$pedi_destinatario= '';
		$pedi_pesob		  = '';	
		$pedi_volume      = '';
		$pedi_nnf		  = '';
		$pedi_flag		  = '';
        $pedi_email       = '';

		
?>
<style>
.etiq {
		display		  	  : none;
	}		
	
.etiq1 {
	    position	  	  : absolute;
	    top    		  	  : 85px;
     	width  		  	  : 455px;
		height 		  	  : 250px;
		border 		  	  : 0px solid #999;
		border-radius	  : 10px;
	}
	
.conteudo {
	    
		padding		  	  : 5px 10px 5px 10px;
	}		
      
</style>

<script>
	function identEtiqueta(p,n,v) {
		$att('#fundo3').css('display', 'block');
		$att('#consulta').css('display', 'block')
	    .load('forms/consulta.php',{ modulo:p, chave:n, volume:v });	
		
	}
</script>

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
						<h3 class="page-header text-center" style="font-weight:bold; color:#4F94CD">
							<input id="pedi_codigo" name="pedi_codigo" readonly="true" value="<?=$pedi_codigo;?>">
						</h3>
							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<input id="submit" name="submit" type="submit" value="Confirma" class="btn btn-primary" onclick="javascript:grava_registro('<?=$param;?>')">
								</div>
							</div>

							<div class="form-group">
								<label for="pedi_nf_chave" class="col-sm-2 control-label">ch.acesso</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="pedi_nf_chave" name="pedi_nf_chave" placeholder="Chave de Acesso" 
									value="<?=utf8_encode( $pedi_nf_chave ); ?>" onblur="if(this.value != '') {check_xml(this.value);}" >
								</div>
							</div>
							
							<div class="form-group">
								<label for="pedi_id" class="col-sm-2 control-label">Id.</label>
								<div class="col-sm-5">
									<input type="text" required="required" class="form-control" id="pedi_id_cli" name="pedi_id_cli" placeholder="Id. do Cliente" value="<?=utf8_encode( $pedi_id_cli ); ?>">
								</div>
								
								<div class="col-sm-5">
									<input type="text" required="required" class="form-control" id="pedi_dt_registro" name="pedi_dt_registro" placeholder="data de Emissão" value="<?=utf8_encode( $dt_registro ); ?>" disabled="true">
								</div>
								
							</div>
						
							<div class="form-group">
								<label for="pedi_cli" class="col-sm-2 control-label">Cliente</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="pedi_nm" name="pedi_nm" placeholder="Nome do Cliente" value="<?=utf8_encode( $pedi_nm_cli); ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="pedi_rem" class="col-sm-2 control-label">Remetente</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="pedi_remetente" name="pedi_remetente" placeholder="Remetente" value="<?=$pedi_remetente; ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="pedi_des" class="col-sm-2 control-label">Destinatario</label>
								<div class="col-sm-10">
									<input type="text" required="required" class="form-control" id="pedi_destinatario" name="pedi_destinatario" placeholder="Destinatario" value="<?=$pedi_destinatario; ?>">
								</div>
							</div>

					</div>
				</div>

				<div class="ladoB ladoB1 ladoB2">
					<div class="col-md-12">
							<div class="form-group">
								<label for="pedi_pbruto" class="col-sm-2 control-label">P.Bruto</label>
								<div class="col-sm-4">
									<input type="text" required="required" class="form-control" id="pedi_pesob" name="pedi_pesob" placeholder="Peso Bruto" value="<?=$pedi_pesob; ?>">
								</div>

								<label for="pedi_volume" class="col-sm-2 control-label">Volume</label>
								<div class="col-sm-4">
									<input type="text" required="required" class="form-control" id="pedi_volume" name="pedi_volume" placeholder="Volumes" value="<?=$pedi_volume; ?>">
								</div>
							</div>
							
					        <div class="form-group">
								<label for="pedi_nnf" class="col-sm-2 control-label">N.Fiscal</label>
								<div class="col-sm-4">
									<input type="text" required="required" class="form-control" id="pedi_nnf" name="pedi_nnf" placeholder="Nr. N.Fiscal" value="<?=$pedi_nnf; ?>">
								</div>
							</div>	
							                           
							<div class="form-group etiq">
							    <div id="etiqueta">
								<label for="pedi_impr" class="col-sm-2 control-label">
									<a href="javascript:identEtiqueta(5,$('#pedi_nf_chave').val(),$('#pedi_volume').val())"><b>Imprimir Etiqueta</b>
								</label>
								<div class="col-sm-4">
									<img src='imgs/ico_print.png'></a>
								</div>
								</div>
							</div>
                            							
							<div id="etiq1" class="etiq1"></div>
					</div>
						
				</div>				
				<div class="avisa"></div>
			</div>	
			
			<div id="menu1" class="tab-pane fade"><!--menu1-->
				<div class="col-lg-12">
					<h4 class="modal-title" style="font-weight:bola; color:#000">Produtos</h4>					
					<div id="produtos"> 			
						<table class="table-striped table-bordered table-hover table"><!-- pedidos.css-->
							
								<thead>
									<tr>
										<th><center>C&Oacute;DIGO</center></th>
										<th class='de600'><center>PRODUTO<a href='#'><img width='15' src='../../htms/imgs/adicionar1.png'></a></center></th>
										<th><center>QTDE</center></th>
										<th class='de600'><center>PRE&Ccedil;O</center></th>
										<th><center>PRE&Ccedil;O TOTAL</center></th>
										<th class='ate900'><center>IMG</center></th>
									</tr>
								</thead>
					
								<?php
								if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){

									$type    	= $cfg['conexao']['type'];
									$host    	= $cfg['conexao']['host'];
									$user    	= $cfg['conexao']['user'];
									$pass    	= $cfg['conexao']['pass'];
									$name    	= $cfg['conexao']['name'];
									$port    	= $cfg['conexao']['port'];
									//----------- Conexao a Base de Dados--------------------------------------------------------------------------		
									$conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
									$consulta = $conn->prepare("SELECT
																	codpro, pedi_id, codigo, descricao, 
																	coddis, codgru, codori, codven, codmar, 
																	precov, imagem, quantidade
																FROM cada_material											
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
																								
//-------------------------------------------------------------------------------------------------------------------------------------													?>
								<tr>
									<td><a href="javascript:abre_produto('<?=$mat_codpro;?>','<?=$objretorno;?>','<?=$param;?>')">
										<center><?=$mat_codigo;?></center></a>
									</td>
									<td class='de600'>
										<center><?=utf8_encode(substr('Nome que sera impresso na campo, teste de quantidade de caracteres',0,40));?></center>
									</td>
									<td><center><?=$mat_quanti;?></center></td>
									<td class='de600'><center><?=moeda($mat_precov);?></center></td>
									<td><center><?=moeda($mat_precov*$mat_quanti);?></center></td>
									<td class='ate900'><center><?=$mat_imagem;?></center></td>
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
<?
	} else	{// se nao existir, lançara um erro
	throw new Exception("Arquivo de Configuracao Mysql.ini não encontrado");
}	
?>
