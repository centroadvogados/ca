<?php
 session_start();
 $param     = $_POST['param'];
 $codgru    = $_POST['codgru'];
 $modulo    = $_POST['modulo'];
?>

	
<script>
		$(document).ready(function() {
			$('#tabbela1').DataTable({
					responsive: true
			});
		});
</script>



			<?php
			if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){
					$type    	= $cfg['pcostura']['type'];
					$host    	= $cfg['pcostura']['host'];
					$user    	= $cfg['pcostura']['user'];
					$pass    	= $cfg['pcostura']['pass'];
					$name    	= $cfg['pcostura']['name'];
					$port    	= $cfg['pcostura']['port'];
					$n1			= $cfg['nivel']['n1'];
                    $n2			= $cfg['nivel']['n2'];
					$n3			= $cfg['nivel']['n3'];
					$n4			= $cfg['nivel']['n4'];
					$conn  		= new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
			?>
			
          
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
					   //----------- Produtos ----------------------------------------- 					
						if ( $prd = parse_ini_file($n2."cfg.mobile/produtos.ini",true) ){
							$imagem   	= $prd['local']['imagem'];
						}						
						//----------- Conexao a Base de Dados Produtos-----------------------------------------------------------------	
						if ($codgru==0){	
							$cons_produto = $conn->prepare("SELECT * FROM pecascostura");
					    } else {
							$cons_produto = $conn->prepare("SELECT 	p.codpro, p.codgru, p.codmar, p.codigo, p.codori, 
																	p.descricao, p.precov, p.marca, p.precocusto, p.imagem,
																	p.dtentrada, p.lote, p.precoespecial, p.valorespecial,	
																	g.nome, g.tipo
															FROM cada_pecas AS p 
															INNER JOIN cada_grupec AS g ON g.codgru = p.codgru 
															WHERE p.codgru = $codgru
															");
						}								   
						
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
								$produto=$imagem.'pecas/';
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
									<center><a href='#' onclick='return detalhe(<?=$imagem.$prod_imagem;?>,0)'>
										<img class='detalhe' src='<?=$produto.$prod_imagem;?>' heigth=17 width=17 border=0></a>
									</center>
								</td>
							</tr>
						<?php	
							}
						}
						?>		
					</table>
				</div>
			
	<?php   } ?>				

