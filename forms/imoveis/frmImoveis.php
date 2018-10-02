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
			 .load('forms/imoveis/frmSelect.php',{ param:p, modulo:pr, codgru:grupo });
        });
    </script>
</head>   
<body onLoad="if(ieBlink){setInterval('doBlink()',450)}" scrollbars="yes">

        <div class="row modal-header" style="background: #d9edf7; border-radius: 10px 10px 0px 0px; max-height:50px;">
		 	<a href="home"><img src="imgs/remove.png" alt="Fecha Janela" class="direita" /></a>
			<h3 class="modal-title" style="font-weight:bold; font-size:20pt; color:#4F94CD">Im&oacute;veis</h3> 
			
            <div class="col-lg-12">
			<?php 
			
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
																FROM cada_gruimo AS g 
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
												
								echo '<option value="'.$codgru.'">'.utf8_encode($nome).'</option>';
							}
						}
					   
						//----------- imoveis ----------------------------------------- 					
						//if ( $prd = parse_ini_file($n2."cfg.mobile/produtos.ini",true) ){
						//	$imagem   	= $prd['local']['imagem'];
						//}
						 
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
								<th class='ate900'><center>SERVI&Ccedil;O</center></th>
							</tr>
						</thead>
						<?php
						//----------- Conexao a Base de Dados imoveis-----------------------------------------------------------------		
												
						$cons_produto = $conn->prepare("SELECT 	p.idpro, p.codgru, p.codmar, p.codigo, p.codori, 
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
														;");
			
						$cons_produto->execute();
						
						if ( $cons_produto->rowCount() ) {
							// percorre os resultados via iteração
							foreach($cons_produto as $row){				
							// exibe os resultados
							$imov_id 		  	= $row["idpro"];
							$imov_codgru	  	= $row["codgru"];
							$imov_codmar	  	= $row["codmar"];
							$imov_codigo	  	= $row["codigo"];
							$imov_codori	  	= $row["codori"];
							$imov_descricao   	= $row["descricao"];
							$imov_precov	  	= $row["precov"];	 
							$imov_marca		  	= $row["marca"];
							$imov_precocusto  	= $row["precocusto"];
							$imov_tipo		  	= $row["tipo"];
							
							$imov_imagem	  	= $row["imagem"];
							$imov_dtentrada   	= $row["dtentrada"];
							$imov_lote 		  	= $row["lote"];
							$imov_precoespecial = $row["precoespecial"]; 
							$imov_valorespecial = $row["valorespecial"];
							$imov_nomegru 	  	= $row["nome"];
                            $imov_descradm    	= $row["descradm"];	
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
							
							
							//if($imov_tipo==5){
								$caminho='imgs/imoveis/';
								$modulo = 2;
							//}
										
							$dados	= array(0  =>	$imov_id, 			
											1  =>	$imov_codgru,
										    2  =>	$imov_codmar,
											3  =>	$imov_codigo,
											4  =>	$imov_codori,
											5  =>	$imov_descricao,
											6  =>	$imov_precov,
											7  =>	$imov_marca,
											8  =>	$imov_precocusto,
											9  => 	$imov_tipo,
											
 											10 =>	$imov_imagem,
											11 =>	$imov_nomegru,
											12 =>	$imov_dtentrada,
											13 =>	$imov_lote,
											14 =>	$imov_precoespecial,
											15 =>	$imov_valorespecial,
											16 =>   $imov_descradm,
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
								<td><a href="javascript:abre_registro('<?=$imov_id;?>','<?=$objretorno;?>','<?=$param;?>','<?=$modulo;?>')">
									<center><?=substr(utf8_encode($imov_codigo),0,40);?></center></a>
								</td>
								<td><center><?=substr(utf8_encode($imov_descricao),0,20);?></center></td>
								<td><center><?=$imov_precov;?></center></td>
								<td class='de600'><center><?=utf8_encode( $imov_nomegru );?></center></td>
								<td class='ate900'>
									<center><?=utf8_encode($imov_descradm);?></center>						
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
