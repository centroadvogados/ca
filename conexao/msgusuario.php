<?php 
	session_start(); 
    $nv	=2; //$_POST['nivel'];
	echo "<script> var nv=$nv; </script>";
?>
    
<!doctype html>
<html lang="br">
<head>
  <meta charset="utf-8">
  <title>Invalidacao de Usuario:</title>
</head>
<style>
	.dvcentro { 
			  position			:absolute;
			  background-color	:transparent;
			  width 	    	:250px;
			  height			:150px;		  
			  top   			: 25%;
			  text-align   	    : left;
			  padding-left		: 18%;
			  z-index    		: 85;
		}	

	.toppo { 
			  position			:relative;
			  background-color	:#ccc;
			  width 	    	:100%;
			  height			:20px;		  
			  top   			: 0px;
			  z-index    		: 85;
		}
		                
    @font-face {
		    font-family: Dog Rough;
		    src: url('../css/fonts/Dog Rough.otf');
		}
		
		fbe {
			margin:0px auto;
			width:400px;
			text-align:center;
			font:36px Dog Rough, Arial, Tahoma, Sans-serif;
		}
		
		fbe small {font-size:10px; font-family:Dog Rough;}
                
    
		
</style>
    <div class="modal-header" style="rgba(217, 237, 247, 0.32); border-radius: 10px 10px 0px 0px; max-height:15px;">
      <a href="javascript:fecha_blackbox(nv)"><img src='imgs/remove.png' alt='Fecha Janela' class='direita' /></a>
      <br><br>
	  
      <center><img width='40' src='imgs/usuario-nao-autorizado-icon.png' alt='Fecha Janela' /></center>
	    
      <label for="cabecalho">
       <font face='arial' size='4' color='#222'> 
         <fbe>Usu&aacute;rio n&atilde;o Autorizado</fbe> 
       </font>		
      </label><br><br><br>
     <div id='message' class='msg2'>&nbsp;</div>
	</div> 
</html>