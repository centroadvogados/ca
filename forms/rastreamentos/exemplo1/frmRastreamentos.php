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
			$('#tabbela').DataTable({ responsive: true });
		});
    </script>
    
</head>
<body onLoad="if(ieBlink){setInterval('doBlink()',450)}" scrollbars="yes">

        <div class="row modal-header" style="background: #d9edf7; border-radius: 10px 10px 0px 0px; max-height:50px;">
         
			   
					<a href="javascript:fecha_tabela()"><img src='imgs/btn_x.png' alt='Fecha Janela' class='direita' /></a>
					<h3 class="modal-title" style="font-weight:bold; font-size:20pt; color:#4F94CD">Rastreamentos</h3> 
                    
                        <div id="mapa" style="height: 410px; width: 900px; border: 1px solid #D5CDCD; "></div>
                   
				
			
        </div>
</body>

</html>