<html lang="pt">

<link href="jquery.dataTables.min.css" rel="stylesheet">

<script src="../js/jquery.js"></script>
<script src="jquery-1.12.3.js"></script>
<!--<script src="jquery.dataTables.min.js"></script>-->

<script src="../forms/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../forms/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="../forms/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

	<script>
		$(document).ready(function){
			var oTable = $('#tabella').dataTable( {
					"sScrolly"	: 200,
					"sScrollX"	: "100%",
					"sScrollXInner"	: "110%"
			} );
		
			var keys =  new KeyTables( {
					"table": document.getElementById('tabella'),
					"datatable": oTable
			} )	
		}
	</script>	
	
<?php
error_reporting(0);
ini_set(display_errors, 0 ); //inibe mensagens alerta*/

function __autoload($classe)
{
    $pastas = array('../classes/conexao');
    foreach ($pastas as $pasta)
    {
        if (file_exists("{$pasta}/{$classe}.class.php"))
        {
    
		include_once "{$pasta}/{$classe}.class.php";
			echo 'Arquivo '."{$pasta}/{$classe}.class.php".",<br> ENCONTRADO... ";echo '<br>';
        } else {
		    echo 'Arquivo '."{$pasta}/{$classe}.class.php".",<br> NAO ENCONTRADO... ";echo '<br>';
		}
		
    }
}


//$var='mysql'; // Variavel referente ao Banco de Dados
    if ( $cfg = parse_ini_file("../cfg.mobile/config.ini",true) ){
		$type    	= $cfg['conexao']['type'];
       

		if (file_exists("../cfg.mobile/{$type}.ini"))
		{ 
			
			// lê o INI e retorna um array
				$db = parse_ini_file("../cfg.mobile/{$type}.ini");
			// lê as informações contidas no arquivo
				$user  = $db['user'];
				$pass  = $db['pass'];
				$name  = $db['name'];
				$host  = $db['host'];
				$type  = $db['type'];
				$porta = $db['port'];		
				echo 'Arquivo Existe <br><br>';
				echo('usuario  :'.$user.'<br>');
				echo('password :'.md5($pass).'<br><br>');
				echo('Nome Banco :'.$name.'<br>');
				echo('Servidor :'.$host.'<br><br>');
				echo('Tipo Banco :'.$type.'<br><br>');
				echo('Porta Banco :'.$porta.'<br><br>');

$server   =   "localhost";  
$bd       =   "aquitudo_att";
/*
$server   =   "aquitudotem.com";  
$bd       =   "aquitudotem_attweb";

$username =   "aquitudotem"; */

$username =   "ejoaquim";
$passwd   =   "noslimde";


//conectando
$conn    =   @mysql_connect($host, $user, $pass) 
             or die("Erro na CONEXÃO Com o Database");

//Seleciona o DataBase a ser Utilizado
$db      =   @mysql_select_db($bd, $conn)
             or die("Erro na Seleção DO DATABASE WEB");				

        $pessoa = mysql_query("select pess_id, pess_nm, pess_email, pess_senha, pess_end, pess_bairro 
                                 from cada_pessoas 
                                ");

        $row    = mysql_num_rows($pessoa);
       
        if ($pessoa AND $row != 0)
        {?>
	
		<table id="tabella" class="display table-striped table-bordered table-hover table" cellspacing="0" width="60%" border="1">
			<thead>
				<tr>
					<th>id</th>
					<th>Nome</th>
					<th>Endereco</th>
					<th>Bairro</th>					
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>id</th>
					<th>Nome</th>
					<th>Endereco</th>
					<th>Bairro</th>					
				</tr>
			</tfoot>
	     <?
				while ($r = mysql_fetch_array($pessoa))
				 {
					$id          = $r['pess_id']    	;
					$nm          = $r['pess_nm']		;
					$apld        = $r['pess_apld']		;
					$end         = $r['pess_end']		;
					$end_nr	     = $r['pess_end_nr']	;	
					$compl       = $r['pess_compl']		;
					$bairro      = $r['pess_bairro']	;
					$cep         = $r['pess_cep']		;
					$fone        = $r['pess_tel']		;
					$fax         = $r['pess_fax']		;
					$cnpjcpf     = $r['pess_cnpj_cpf']	;
					$ierg        = $r['pess_insc_rg']	;
					$dt_ab	     = $r['pess_dt_aber_nasc']	;
					$contato     = $r['pess_contato']	;
					$site        = $r['pess_site']		;
					$email       = $r['pess_email']		;
					$dt_inc	     = $r['pess_dt_inc']	;
					$tp_pessoa   = $r['pess_tp_pessoa']	;
					$pess_delete = $r['pess_delete']	;
					$ativ_id     = $r['pess_ativ_id']	;
					$esta_ibge   = $r['pess_esta_ibge']	;
					$muni_ibge   = $r['pess_muni_ibge']	;
					$senha	     = $r['pess_senha'] 	;
					?><tbody>
						<tr>
							<td><?=$r['pess_id'];?></td>
							<td><?=$r['pess_nm'];?></td>
							<td><?=$r['pess_end'];?></td>
							<td><?=$r['pess_bairro'];?></td>
						</tr>
					  </tbody> 
					<?				 
					
				}
					?>
		</table>
					<?
	
				
		}
 } 	
}



//---------------------------------------------------------------------------------------------------------------------
			
?>