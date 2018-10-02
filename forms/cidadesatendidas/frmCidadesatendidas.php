<?php
 session_start();
 $param=$_POST['param'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt">

	<head>
	
    <script>
		$(document).ready(function() {
			$('#tabbela').DataTable({
					responsive: true
			});
		});
    </script>

	</head>
<body onLoad="if(ieBlink){setInterval('doBlink()',450)}" scrollbars="yes">

        <div class="row modal-header" style="background: #d9edf7; border-radius: 10px 10px 0px 0px; max-height:50px;">
            <div class="col-lg-12">
			    
			    <table id="tabbela" class="table-striped table-bordered table-hover table"><!-- estilo da tabela zebra, borda, focus e		responsiva-->
					<a href="javascript:fecha_tabela()"><img src='imgs/btn_x.png' alt='Fecha Janela' class='direita' /></a>
					<h3 class="modal-title" style="font-weight:bold; font-size:20pt; color:#4F94CD">Cidades Atendidas</h3> 
								<thead>
	                                <tr>
										<th><center>COD. IBGE</center></th>
                                        <th><center>CIDADE</center></th>
										<th class='de600'><center>ESTADO</center></th>
                                       <th class='de600'><center>ESTADO</center></th>
 									</tr>
								</thead>
								<?php
 								  if ( $cfg = parse_ini_file("../../cfg.mobile/config.ini",true) ){

										$type    	= $cfg['conexao']['type'];
										$host    	= $cfg['conexao']['host'];
										$user       = $cfg['conexao']['user'];
										$pass      	= $cfg['conexao']['pass'];
										$name     	= $cfg['conexao']['name'];
										$port    	= $cfg['conexao']['port'];
									    $n2	    	= $cfg['nivel']['n2'];
									  
									    function __autoload($classe)
											{
												$pastas = array('$n2.classes/conexao');
												foreach ($pastas as $pasta)	{
													if (file_exists("{$pasta}/{$classe}.class.php"))
													{
														include_once "{$pasta}/{$classe}.class.php";
													}
												}
											}

									//----------- Conexao a Base de Dados--------------------------------------------------------------------------		
									 
										    $conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
											// instancia objeto PDO, conectando MySql, executa uma instrução SQL de consulta
											$consulta = $conn->prepare(
																		"SELECT  e.esta_ibge, e.esta_nm, e.esta_uf, 
																		                 m.muni_ibge, m.muni_nm, m.esta_ibge
																		FROM cada_estados AS e
																		INNER JOIN cada_municipios  AS m ON e.esta_ibge = m.esta_ibge
																		"); 
																		
											$consulta->execute();
																						
											//$retorno = $consulta->rowCount();						   
															   
										   //if ( $retorno>0 ) 
											if ( $consulta->rowCount() )    
											{
												// percorre os resultados via iteração
												foreach($consulta as $row){				
													// exibe os resultados
													$muni_ibge 		   = $row["muni_ibge"]; 
													$muni_nm 		   = $row["muni_nm"]; 
													$esta_ibge 		    = $row["esta_ibge"]; 
													$esta_nm 			= $row["esta_nm"];
													$esta_uf			  = $row["esta_uf"];
													
													
													$dados	= array( 0  =>	$muni_ibge, 			
																	 1  =>	$muni_nm,
																	 2  =>	$esta_ibge,
																	 3  =>	$esta_nm,
																	 4  =>	$esta_uf
													); 				
															
													$objretorno = implode('|',$dados);
//-------------------------------------------------------------------------------------------------------------------------------------												
												
								?>
													
													<tr>
														<td><center><?=$muni_ibge;?></center></td>
														<td><a href="javascript:abre_registro('<?=$pess_id;?>','<?=$objretorno;?>','<?=$param;?>')">
														    <center><?=substr(utf8_encode($muni_nm),0,80);?></center></a>
														</td>
														<td class='de600'><center><?=utf8_encode( $esta_uf );?></center></td>
														<td class='de600'><center><?=utf8_encode( $esta_nm );?></center></td>
													</tr>
											        
								<?php	
												}
											}
									} 							
										
								?>		
				</table>
			</div>
        </div>
</body>

</html>