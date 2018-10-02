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
					$type    	= $cfg['imoveis']['type'];
					$host    	= $cfg['imoveis']['host'];
					$user    	= $cfg['imoveis']['user'];
					$pass    	= $cfg['imoveis']['pass'];
					$name    	= $cfg['imoveis']['name'];
					$port    	= $cfg['imoveis']['port'];
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
								<th class='ate900'><center>SERVI&Ccedil;O</center></th>
							</tr>
						</thead>
						<?php
					   //----------- Produtos ----------------------------------------- 					
						if ( $prd = parse_ini_file($n2."cfg.mobile/produtos.ini",true) ){
							$imagem   	= $prd['local']['imagem'];
						}						
						//----------- Conexao a Base de Dados Produtos-----------------------------------------------------------------	
						if ($codgru==0){	
							$cons_produto = $conn->prepare("
														SELECT 	p.idpro, p.codgru, p.codmar, p.codigo, p.codori, 
																p.descricao, p.precov, p.marca, p.precocusto, p.imagem,
																p.dtentrada, p.lote, p.precoespecial, p.valorespecial,
																p.descradm, p.imo_end, p.imo_esta_ibge, p.imo_muni_ibge,
																p.imo_area_total, p.imo_area_construida, p.imo_dormitorio,
																p.imo_suite, p.imo_cozinha, p.imo_banheiro, p.imo_sala,
																p.imo_vaga_garagem, p.imo_id_obs,p.codcli,
																g.nome, g.tipo,
																c.clie_dt_ul_compra, c.clie_vl_ul_compra, c.pedi_codigo,
																e.esta_uf, e.esta_nm, m.muni_nm
														FROM imoveis.cada_imoveis AS p 
														INNER JOIN imoveis.cada_gruimo AS g ON g.codgru = p.codgru
														INNER JOIN aquitudo_att.cada_clientes AS c ON c.clie_id = p.codcli
														INNER JOIN aquitudo_att.cada_estados  AS e ON e.esta_ibge = p.imo_esta_ibge
														INNER JOIN aquitudo_att.cada_municipios AS m ON m.muni_ibge=p.imo_muni_ibge
														ORDER BY p.dtentrada
							");
					    } else {
							$cons_produto = $conn->prepare("
														SELECT 	p.idpro, p.codgru, p.codmar, p.codigo, p.codori, 
																p.descricao, p.precov, p.marca, p.precocusto, p.imagem,
																p.dtentrada, p.lote, p.precoespecial, p.valorespecial,
																p.descradm, p.imo_end, p.imo_esta_ibge, p.imo_muni_ibge,
																p.imo_area_total, p.imo_area_construida, p.imo_dormitorio,
																p.imo_suite, p.imo_cozinha, p.imo_banheiro, p.imo_sala,
																p.imo_vaga_garagem, p.imo_id_obs,p.codcli,
																g.nome, g.tipo,
																c.clie_dt_ul_compra, c.clie_vl_ul_compra, c.pedi_codigo,
																e.esta_uf, e.esta_nm, m.muni_nm
														FROM imoveis.cada_imoveis AS p 
														INNER JOIN imoveis.cada_gruimo AS g ON g.codgru = p.codgru
														INNER JOIN aquitudo_att.cada_clientes AS c ON c.clie_id = p.codcli
														INNER JOIN aquitudo_att.cada_estados  AS e ON e.esta_ibge = p.imo_esta_ibge
														INNER JOIN aquitudo_att.cada_municipios AS m ON m.muni_ibge=p.imo_muni_ibge							
														WHERE p.codgru = $codgru
							");
						}								   
						
						$cons_produto->execute();
						
						if ( $cons_produto->rowCount() ) {
							// percorre os resultados via iteração
							foreach($cons_produto as $row){				
							// exibe os resultados
							$prod_id 		  = $row["idpro"];
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
							$prod_descradm	  = $row["descradm"];
							$imo_end			= $row["imo_end"]; 
							$imo_esta_ibge		= $row["imo_esta_ibge"]; 
							$imo_muni_ibge		= $row["imo_muni_ibge"];
							
							$imo_area_total		= $row["imo_area_total"];
							$imo_area_construida= $row["imo_area_construida"]; 
							$imo_dormitorio		= $row["imo_dormitorio"];
							$imo_suite			= $row["imo_suite"]; 
							$imo_cozinha		= $row["imo_cozinha"]; 
							$imo_banheiro		= $row["imo_banheiro"]; 
							$imo_sala			= $row["imo_sala"];
							$imo_vaga_garagem	= $row["imo_vaga_garagem"]; 
							$imo_id_obs			= $row["imo_id_obs"];
							$imo_codcli			= $row["codcli"];
							
							$imo_clie_dt_ul_compra	= $row["clie_dt_ul_compra"];
							$imo_clie_vl_ul_compra	= $row["clie_vl_ul_compra"]; 
							$imo_pedi_codigo		= $row["pedi_codigo"];
							$imo_esta_uf			= $row["esta_uf"];
							$imo_esta_nome			= $row["esta_nm"];
							$imo_muni_nm			= $row["muni_nm"];
	
							//if($prod_tipo==2){
								$produto=$imagem.'imoveis/';
								//$modulo = 2;
							//}							
										
							$dados	= array(0  =>	$prod_id, 			
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
											15 =>	$prod_valorespecial,
											16 =>	$prod_descradm,
											17 =>   $imo_end,
											18 =>   $imo_esta_ibge,
											19 =>   $imo_muni_ibge,
											
											20 =>   $imo_area_total,
											21 =>   $imo_area_construida,
											22 =>   $imo_dormitorio,
											23 =>   $imo_suite,
											24 =>   $imo_cozinha,
											25 =>   $imo_banheiro,
											26 =>   $imo_sala,
											27 =>   $imo_vaga_garagem,
											28 =>   $imo_id_obs,
											29 =>   $imo_codcli,
											
											30 =>   $imo_clie_dt_ul_compra,	
											31 =>   $imo_clie_vl_ul_compra,
											32 =>   $imo_pedi_codigo,
											33 =>   $imo_esta_uf,
											34 =>   $imo_esta_nome,
											35 =>   $imo_muni_nm											 
											); 
											
							$objretorno = implode('|',$dados);
	//-------------------------------------------------------------------------------------------------------------------------------------																	
						?>
							<tr>
								<td><a href="javascript:abre_registro('<?=$prod_id;?>','<?=$objretorno;?>','<?=$param;?>','<?=$modulo;?>')">
									<center><?=substr(utf8_encode($prod_codigo),0,40);?></center></a>
								</td>
								<td><center><?=substr(utf8_encode($prod_descricao),0,20);?></center></td>
								<td><center><?=$prod_precov;?></center></td>
								<td class='de600'><center><?=utf8_encode( $prod_nomegru );?></center></td>
								<td class='de600'><center><?=substr(utf8_encode( $prod_marca ),0,13);?></center></td>
								<td class='ate900'>
									<center><a href='#' onclick='return detalhe(<?=$imagem.$prod_imagem;?>,0)'>
										<?=utf8_encode( $prod_descradm );?></a>
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

