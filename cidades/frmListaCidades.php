<?php
 session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt">

	<head>
	
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

	</head>
<body onLoad="if(ieBlink){setInterval('doBlink()',450)}" scrollbars="yes">

    <!--<div id="wrapper">-->
        <div class="row">
            <div class="col-lg-12">
			    <!--<div class="panel panel-default">-->
                    <div class="panel-heading">
						Lista Cidades<a href="javascript:fecha_tabela()"><img src='imgs/btn_x.png' alt='Fecha Janela' class='direita' /></a>
					</div><!-- /.panel-heading -->
                <!--</div>-->	
					
					
						<div class="dataTable_wrapper">
						    
							<table class="table-striped table-bordered table-hover table" id="dataTables-example"><!-- estilo da tabela zebra, borda, focus e responsiva-->
								<thead>
	                                <tr>
                                        <th><center>CIDADE</center></th>
                                        <th class='de600'><center>ESTADO</center></th>
                                        <th class='de600'><center>CIDADE</center></th>
 									</tr>
								</thead>
									<?php
									function __autoload($classe)
									{
										$pastas = array('../classes/conexao');
										foreach ($pastas as $pasta)	{
											if (file_exists("{$pasta}/{$classe}.class.php"))
											{
												include_once "{$pasta}/{$classe}.class.php";
											}
										}
									}
									
									if ( $cfg = parse_ini_file("../cfg.mobile/config.ini",true) ){
											$type    	= $cfg['conexao']['type'];
											  
										   //$conn = TConexao::open('mysql');
											if (file_exists("../cfg.mobile/mysql.ini"))
												{// lê o INI e retorna um array
													$db = parse_ini_file("../cfg.mobile/mysql.ini");
													$user  = $db['user'];
													$pass  = $db['pass'];
													$name  = $db['name'];
													$host  = $db['host'];
													$port  = $db['port'];
													$type  = $db['type'];
												} 	else   {// se não existir, lança um erro
													throw new Exception("Arquivo de Configuracao Mysql.ini não encontrado");
												}	
									//----------- Conexao a Base de Dados--------------------------------------------------------------------------		
									 
										    $conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
											// instancia objeto PDO, conectando MySql, executa uma instrução SQL de consulta
											$consulta = $conn->query(	"SELECT muni_ibge, muni_nm, esta_ibge  
																		 FROM cada_municipios 
																		 ORDER BY muni_nm
																   "); 

											$consulta->execute();
											$retorno = $consulta->rowCount();						   
															   
										   if ( $retorno>0 ) 
											{
												// percorre os resultados via iteração
												foreach($consulta as $row){				
													// exibe os resultados
													$muni_id 			= $row["muni_ibge"];
													$muni_nm 			= $row["muni_nm"];
                                                    $muni_esta_ibge		= $row["esta_ibge"]; 													
													
													$ret	= array( 0  =>	$muni_id , 			
																	 1  =>	$muni_nm ,
																	 2  =>	$muni_esta_ibge
													);
															
													$objretorno = implode('|',$ret);
//-------------------------------------------------------------------------------------------------------------------------------------												
													$telefones = $conn->prepare("SELECT tele_id, tele_tel, tele_contato, oper_id, pess_id 
																				FROM cada_telefones 
																				WHERE tele_id = :codfone; ");
													$telefones->bindParam( ':codfone', $pess_tel, PDO::PARAM_INT );  
													$telefones->execute();
													

													foreach ( $telefones->fetchAll(PDO::FETCH_ASSOC) as $fone ){
														$tele_id			=	$fone["tele_id"];
														$tele_tel			=	$fone["tele_tel"];
														$tele_contato 		= 	$fone["tele_contato"];
														}												
												
									?>

												    
													<!--<tbody>-->
													<tr>
														<td><a href="javascript:abre_registro('<?=$pess_id;?>','<?=$objretorno;?>')">
														    <center><?=substr(utf8_encode($pess_nm),0,40);?></center></a>
														</td>
														<td><center><?=substr(utf8_encode($pess_end),0,20);?></center></td>
														<td><center><?=$tele_tel;?></center></td>
														<td class='de600'><center><?=utf8_encode( $esta_uf );?></center></td>
														<td class='de600'><center><?=substr(utf8_encode( $muni_nm ),0,13);?></center></td>
														<td class='ate900'><center><?=substr(utf8_encode($pess_contato),0,9);?></center></td>
													</tr>
													<!--</tbody>-->
													
													
											        
									<?php	
												}
											}
									
										
									} 							
										
									?>		
							</table>
							
						</div><!--<dataTable_wrapper>-->
            </div>
        </div><!-- /.col-lg-12 -->
            <!-- /.row -->			
	<!--</div><!-- wrapper -->
			
   

</body>

</html>