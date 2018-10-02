<?php
 session_start();
 $param=$_POST['param'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt">
<meta name="viewport" content="initial-scale=1.0">
<meta charset="utf-8">
<head>
    <script>
		$(document).ready(function() {
			$('#tabbela').DataTable({
					responsive: true
			});
		});
	
    </script>
		
	<style>
      #map {
        height				: 410px;
		border 		  		: 1px solid #D5CDCD;  
      }
    </style>
</head>
<body onLoad="if(ieBlink){setInterval('doBlink()',450)}" scrollbars="yes">

        <div class="row modal-header" style="background: #d9edf7; border-radius: 10px 10px 0px 0px; max-height:50px;">
            <div class="col-lg-12">
			    <table id="tabbela" class="table-striped table-bordered table-hover table"><!-- estilo da tabela zebra, borda, focus e		responsiva-->
					<a href="javascript:fecha_tabela()"><img src='imgs/btn_x.png' alt='Fecha Janela' class='direita' /></a>
					<h3 class="modal-title" style="font-weight:bold; font-size:20pt; color:#4F94CD">Rastreamentos</h3> 
                    	
                    
                        	<div id="mapa" style="height: 500px; width: 700px; border: 1px solid #D5CDCD; "></div>
		 
		<script src="js/jquery.min.js"></script>
 
        <!-- Maps API Javascript -->
        <script src="http://maps.googleapis.com/maps/api/js?key= AIzaSyBp7dDnzKcd3d3X8GCL1FdTDxHBhvVwZpI&amp;sensor=false"></script>
        
        <!-- Caixa de informação -->
        <script src="js/infobox.js"></script>
		
        <!-- Agrupamento dos marcadores -->
		<script src="js/markerclusterer.js"></script>
 
        <!-- Arquivo de inicialização do mapa -->
		<script src="js/mapa.js"></script>
                    
                    
                    
				</table>
			</div>
        </div>
</body>

</html>