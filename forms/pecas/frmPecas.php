<?php
 session_start();
 $param  =$_POST['param'];
 $modulo =$_POST['modulo']; 
 $codgru =$_POST['codgru'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt">

<head>
    <script>
		$(document).ready(function() {
			$('#tabbela1').DataTable({
					responsive: true
			});
		});
		
		$(document).on('change', '#grupo', function(){  
		let grupo = $('#grupo option:selected').val();
        let p     = '<?=$param;?>';
		let pr    = '<?=$modulo;?>'
		$att('#tabbela0').html('<center><br><br><img src="../imgs/ajax3.gif" alt="consultando"></center>')
			 .load('forms/pecas/frmSelect.php',{ param:p, modulo:pr, codgru:grupo });
        });
    </script>
</head>   
<body onLoad="if(ieBlink){setInterval('doBlink()',450)}" scrollbars="yes">

        <div class="row modal-header" style="background: #d9edf7; border-radius: 10px 10px 0px 0px; max-height:50px;">
		 	<a href="javascript:fecha_tabela()"><img src="imgs/btn_x.png" alt="Fecha Janela" class="direita" /></a>
			<h3 class="modal-title" style="font-weight:bold; font-size:20pt; color:#4F94CD">Pe&ccedil;as</h3> 
			
            <div class="col-lg-12">
			<?php 
			
			if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){
					$type    	= $cfg['pcostura']['type'];
					$host    	= $cfg['pcostura']['host'];
					$user    	= $cfg['pcostura']['user'];
					$pass    	= $cfg['pcostura']['pass'];
					$name       = $cfg['pcostura']['name'];
					$port    	= $cfg['pcostura']['port'];
					$n1			= $cfg['nivel']['n1'];
                    $n2			= $cfg['nivel']['n2'];
					$n3			= $cfg['nivel']['n3'];
					$n4			= $cfg['nivel']['n4'];
				
					function __autoload($classe) {
							$pastas = array('$n2.classes/conexao');
							foreach ($pastas as $pasta)	{
							if (file_exists("{$pasta}/{$classe}.class.php"))
								{
									include_once "{$pasta}/{$classe}.class.php";
								}
							}
					} 				
			
					$conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);

			?>
			
			
				<select class="btn dropdown-toggle btn-default bootstrap-select" name="grupo" id="grupo" onchange="">
						<option value='<?=$codgru;?>'>Todos</option> 
						<?php //----------- Conexao a Base de Dados Grupos--------------------------------------------------
						$cons_grupo = 	$conn->prepare("SELECT g.codgru, g.codmar, g.nome, g.tipo
																FROM cada_grupec AS g 
																ORDER BY g.nome
														"); 
																   
						$cons_grupo->execute();
						if ( $cons_grupo->rowCount() ) {
							// percorre os resultados via iteração
							foreach($cons_grupo as $row){				
								// exibe os resultados
								$codgru 			= $row["codgru"];
								$codmar				= $row["codmar"];
								$nome				= $row["nome"];
								$tipo				= $row["tipo"];
												
								echo '<option value="'.$codgru.'">'.$nome.'</option>';
							}
						}
					   
						//----------- pecas ----------------------------------------- 					
						if ( $prd = parse_ini_file($n2."cfg.mobile/produtos.ini",true) ){
							$imagem   	= $prd['local']['imagem'];
						}
						 
						?>		
				</select>
				
				<div id="tabbela0">			
					<table id="tabbela1" class="table-striped table-bordered table-hover table">
						<thead>
							<tr>
								<th><center>CODIGO</center></th>
								<th><center>DESCRI&Ccedil;&Atilde;O</center></th>
								<th><center>PRE&Ccedil;O</center></th>
								<th class='de600'><center>GRUPO</center></th>
								<th class='de600'><center>MARCA</center></th>
								<th class='ate900'><center>IMAGEM</center></th>
							</tr>
						</thead>
						<?php
						//----------- Conexao a Base de Dados pecas-----------------------------------------------------------------		
												
						$cons_produto = $conn->prepare("SELECT * FROM pecascostura");
			
						$cons_produto->execute();
						
						if ( $cons_produto->rowCount() ) {
							// percorre os resultados via iteração
							foreach($cons_produto as $row){				
							// exibe os resultados
							$prod_id 		  = $row["codpro"];
							$prod_codgru	  = $row["codgru"];
							$prod_codmar	  = $row["codmar"];
							$prod_codigo	  = $row["codigo"];
							$prod_codori	  = $row["codori"];
							$prod_descricao   = $row["descricao"];
							$prod_precov	  = $row["precov"];	 
							$prod_marca		  = $row["marca"];
							$prod_precocusto  = $row["precocusto"];
							$prod_tipo		  = $row["tipo"];
							$prod_imagem	  = $row["imagem"];
							$prod_nomegru 	  = $row["nome"];
							$prod_dtentrada   = $row["dtentrada"]; 
							$prod_lote 		  = $row["lote"]; 
							$prod_precoespecial = $row["precoespecial"]; 
							$prod_valorespecial = $row["valorespecial"];
							
							if($prod_tipo==2){
								$caminho='imgs/pecas/';
								$modulo = 2;
							}
										
							$dados	= array( 0  =>	$prod_id, 			
											 1  =>	$prod_codgru,
											 2  =>	$prod_codmar,
											 3  =>	$prod_codigo,
											 4  =>	$prod_codori,
											 5  =>	$prod_descricao,
											 6  =>	$prod_precov,
											 7  =>	$prod_marca,
											 8  =>	$prod_precocusto,
											 9  =>  $prod_tipo,
 											 10 =>	$prod_imagem,
											 11 =>	$prod_nomegru,
											 12 =>	$prod_dtentrada,
											 13 =>	$prod_lote,
											 14 =>	$prod_precoespecial,
											 15 =>	$prod_valorespecial											 
											); 				
																
							$objretorno = implode('|',$dados);

	//-------------------------------------------------------------------------------------------------------------------------------------																	
						?>
							<tr>
								<td><a href="javascript:abre_registro('<?=$prod_id;?>','<?=$objretorno;?>','<?=$param;?>','<?=$prod_tipo;?>')">
									<center><?=substr(utf8_encode($prod_codigo),0,40);?></center></a>
								</td>
								<td><center><?=substr(utf8_encode($prod_descricao),0,20);?></center></td>
								<td><center><?=$prod_precov;?></center></td>
								<td class='de600'><center><?=utf8_encode( $prod_nomegru );?></center></td>
								<td class='de600'><center><?=substr(utf8_encode( $prod_marca ),0,13);?></center></td>
								<td class='ate900'>
									<center><img class='detalhe' src='<?=$caminho.$prod_imagem;?>' heigth=20  border=0></center>						
								</td>
							</tr>
						<?php
							}
						}
						?>		
					</table>
				</div>
			</div>
	<?php   } ?>				
        </div>
</body>

</html>
