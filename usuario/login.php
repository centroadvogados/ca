<?php session_start(); ?>
    
<!doctype html>
<html lang="br">
<head>
  <meta charset="utf-8">
  <title>Validacao de Usuario:</title>
</head>
<style>
	.dvcentro { 
			  position			: absolute;
			  background-color	: transparent;
			  width 	    	: 250px;
			  height			: 130px;		  
			  top   			:  90px;
			  text-align   	    :  left;
			  padding-left		:  10px;
			  z-index    		:    85;
		}	

	.toppo { 
			  position			: relative;
			  background-color	: #ccc;
			  width 	    	: 100%;
			  height			: 20px;		  
			  top   			:  0px;
			  z-index    		:   85;
		}		
</style>

<script>
	$att("input:text:eq(0):visible").focus();
	$att('#fundo1').css('display', 'block');
	$att('#ajjax').css('display', 'block');
</script>
    <div class="modal-header" style="background: #d9edf7; border-radius: 10px 10px 0px 0px; max-height:15px;">
      <a href="javascript:fecha_login()"><img src='imgs/remove.png' alt='Fecha Janela' class='direita' /></a>
      <br><br>
      <label for="cabecalho">
       <font face='arial' size='3' color='#fff'> 
        <a href="javascript:destruir_sessao()">&copy; PK-Encerrar Sess&atilde;o</a>
       </font>		
      </label>
	  <div class='dvcentro'>
	    <form name='formLogin' id='formLogin' class='form'>
            <br>		
			<label for="usuario">
			 <div width=12px;><img width='15' src='imgs/icone/user.png' alt='Usuario'/>&emsp;<b>usu&aacute;rio</b></div>
			 <input type="text" name="login_mail" id="login_mail" class="email form-control" placeholder="login" required="required"/>
			</label>
			<br>
			<label>
			 <div width=12px;><img width='15' src='imgs/icone/key.png' alt='Usuario'/>&emsp;<b>senha</b></div>
			 <input type="password" name="login_pwd" id="login_pwd"  class="form-control" min="4" placeholder="password" required="required"/>
			</label>
			 			
		     <p class="submit">
			    <input type="button" value="OK" onclick="return valida_login()" class="btn btn-primary"><!-- painel-menu.js -->
		     </p>
		</form>
	  </div>
     <div id='message' class='msg2'>&nbsp;</div>
	</div> 
</html>