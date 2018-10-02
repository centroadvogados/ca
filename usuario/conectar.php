<?php
session_start(); 
/* grupo usuario   1  -	Usuario
					        10-	Administrador
					        20-	Supervisor
					        30-	Gerencia
					
usua_nivel		   0	Desabilitado
					      1	Select			3	Update
					      2	Insert			 4	Delete
*/
error_reporting(0);
ini_set('display_errors', 0 );
$options = array(
	'location' => 'http://127.0.0.1/servicos.attpk/noWSDL/publico/appWS/wsC01.php',
	'uri' => 'http://127.0.0.1/servicos.attpk/noWSDL/publico/appWS/'
);

	$login 	 	   = $_POST['login_mail'];
	$senha	     = md5($_POST['login_pwd']);
							
									if ( $cfg = parse_ini_file("../cfg.mobile/config.ini",true) ) {

										$type    	= $cfg['conexao']['type'];
										$host    	= $cfg['conexao']['host'];
										$user    	= $cfg['conexao']['user'];
										$pass      	= $cfg['conexao']['pass'];
										$name     	= $cfg['conexao']['name'];
										$port    	= $cfg['conexao']['port'];
										$n2	    	= $cfg['nivel']['n2'];
										
										function __autoload($classe) {
											$pastas = array('$n2.classes/conexao');
											foreach ($pastas as $pasta)	{
												if (file_exists("{$pasta}/{$classe}.class.php")) {
													include_once "{$pasta}/{$classe}.class.php";
												}
											}
										}
										//----------- Conexao a Base de Dados--------------------------------------------------------------------------		
									 
										    $conn  = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
											$consulta = $conn->prepare("
											                    SELECT u.usua_id, u.usua_email, u.usua_senha, u.usua_login, u.usua_nm, 
									   										   u.usua_nivel, u.usua_grup_id, u.usua_status, g.grup_id, g.grup_ds, g.grup_nivel
																FROM segu_usuarios AS u
																INNER JOIN segu_grupos  AS g ON u.usua_grup_id = g.grup_id
																WHERE  u.usua_email = '$login' AND u.usua_senha = '$senha'	
																"); 

										    $consulta->execute();
										
											if ( $consulta->rowCount() ) {
													// percorre os resultados via iteraчуo e gera dados da sessao
												    include_once "../classes/app.widgets/TSession.class.php";
													$Sessao = new TSession();
													$var	= "sessao";
													$valor	= session_id();
													$Sessao->setValue($var, $value);												
													foreach($consulta as $row) {				
														// exibe os resultados
														$_SESSION['id']				= $row["usua_id"];
														$_SESSION['email'] 			= $row["usua_email"];
														$_SESSION['senha'] 			= $row["usua_senha"];
														$_SESSION['login'] 			= $row["usua_login"];
														$_SESSION['nome']			= $row["usua_nm"];
														$_SESSION['usu_nivel']	 	= $row["usua_nivel"];
														$_SESSION['usu_grup_id'] 	= $row["usua_grup_id"];
														$_SESSION['usu_status']	  	= $row["usua_status"];
														$_SESSION['grup_id']		= $row["grup_id"];
														$_SESSION['grup_ds']	   	= $row["grup_ds"];
														$_SESSION['grup_nivel']	  	= $row["grup_nivel"];
														$_SESSION['dt_acesso'] 	  	= date('Y-n-j H:i:s');
														$_SESSION['sessiontime'] 	= ( ini_set('session.gc_maxlifetime','0') - 0 ); //Setado valor no php.ini	 
														
														$retorno  = array('codzero'=>0, 'email'=>$row["usua_email"]);
													} 
											
									         }	else { // Usuario ou Senhas Incorreto(s) 
												   $retorno  = array('codzero'=>'Usuario ou Senhas Incorreto(s)', 'email'=>'sistema n&atilde;o conectado');
									         }
									}  else  { // Arquivo de Configuracao Incorreto
										  $retorno  = array('codzero'=>'Erro, Arquivo de Configuracao Incorreto', 'email'=>'sistema n&atilde;o conectado');	  
									}
									$conn   = null;
//-------------------------------------------------------------------------------------------------------------------------------------												
echo ( $objretorno = implode('|',$retorno) );
?>