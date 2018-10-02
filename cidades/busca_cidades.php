<?php
error_reporting(0);
ini_set(display_errors, 0 ); //inibe mensagens alerta*/

if ( $cfg = parse_ini_file("../cfg.mobile/config.ini",true) ){
		$type    	= $cfg['conexao']['type'];
		$host    	= $cfg['conexao']['host'];
		$user    	= $cfg['conexao']['user'];
		$pass       = $cfg['conexao']['pass'];
		$name       = $cfg['conexao']['name'];
		$port    	= $cfg['conexao']['port'];			
		$conn  	    = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);			
	
	$consulta = $conn->prepare("SELECT muni_ibge, muni_nm, esta_ibge  
								FROM cada_municipios 
								WHERE esta_ibge = :estado; ORDER BY muni_nm");
							
	$estado =	filter_var	( $_GET['estado'] );
    $consulta->bindParam( ':estado', $estado, PDO::PARAM_INT );  
    $consulta->execute();
    $contador = $consulta->rowCount();

     if ( $consulta ) {
		 while ($estados = $consulta->fetch( PDO::FETCH_OBJ ))
		 {
					$muni_ibge			= $estados->muni_ibge;
					$muni_nm			= $estados->muni_nm;
					$retorno[$muni_ibge]= $muni_nm;
 		 }

		if ( $contador>0 ){
?>          <select name="cidade" id="cidade">
			  <?php foreach($retorno as $muni_ibge => $muni_nm){
				echo "<option value='{$muni_ibge}'>{$muni_nm}</option>";
			  }
?>			</select>	 
<?php	}
	}
}
?>
