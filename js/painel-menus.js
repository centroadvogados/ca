// parametro p, determina funcao a ser chamada

function construcao() {	
		$att('#fundo1').css('display', 'block');
		$att('#construcao').css('display', 'block')
	    .load('construcao.php',{objeto: '...' });
}

function colaboradores(p,n) {
		$att('#fundo1').css('display', 'block');
		$att(this).html( '<img src="imgs/ajax3.gif">' )
			 .load( 'conexao/direitos.php', {  acao: 1 ,modulo : 1 },
				function(r) {
					retorno = r.split('|');
						if ( retorno[13]==0 ) {
							$att('#tabela').css('display', 'block')
							 .load('forms/colaboradores/frmColaboradores.php',{param:p}); 
						} else {
							$att('#blackbox').css('display', 'block')
							 .load('conexao/msgusuario.php',{ param:p, nivel:n }); 	/* n=nivel , funcao fecha_*/						
						}
				 }
				);       
}

function produtos(p, pr,cd) {
		$att('#fundo1').css('display', 'block');
		$att('#tabela').css('display', 'block')
		.html('<center><br><br><img src="imgs/ajax3.gif" alt="consultando"></center>')
			.load('forms/produtos/frmProdutos.php',{ param:p, modulo:pr, codgru:0 }); /* parametro pr=1 maquinas/ 
																			             pr=2 pecas/
																			*/ 
}

function pecas(p, pr,cd) {
		$att('#fundo1').css('display', 'block');
		$att('#tabela').css('display', 'block')
		.html('<center><br><br><img src="imgs/ajax3.gif" alt="consultando"></center>')
			.load('forms/pecas/frmPecas.php',{ param:p, modulo:pr, codgru:0 }); /* parametro pr=1 maquinas/ 
																			             pr=2 pecas/
																			*/ 
}

function pedidos(p) {
		if (p==4) {
			vpedidos='frmPedidos.php';
		} else {	
			vpedidos='frmIdentificacao.php';
		}
		$att('#fundo1').css('display', 'block');
		$att('#tabela').css('display', 'block')
		.html('<center><br><br><img src="imgs/ajax3.gif" alt="consultando"></center>')
			.load('forms/pedidos/'+vpedidos,{param:p}); 
}

function processos(p) {
		$att('#fundo1').css('display', 'block');
		$att('#tabela').css('display', 'block')
		.html('<center><br><br><img src="imgs/ajax3.gif" alt="consultando"></center>')
			.load('forms/processos/frmProcessos.php',{param:p}); 
}

function identificacao(p) {	
		$att('#fundo1').css('display', 'block');
		$att('#tabela').css('display', 'block')
		.html('<center><br><br><img src="imgs/ajax3.gif" alt="consultando"></center>')
			.load('forms/pedidos/frmIdentificacao.php',{param:p});
}

function rastreamento(p) {
		$att('#fundo1').css('display', 'block');
		$att('#tabela').css('display', 'block')
		.html('<center><br><br><img src="imgs/ajax3.gif" alt="consultando"></center>')
		.load('forms/rastreamentos/frmRastreamentos.php',{param:p},carga); 
}

function cidadesatendidas(p) {
		$att('#fundo1').css('display', 'block');
		$att('#tabela').css('display', 'block')
		.html('<center><br><br><img src="imgs/ajax3.gif" alt="consultando"></center>')
			.load('forms/cidadesatendidas/frmCidadesatendidas.php',{param:p}); 
}
//--------------------------------------------------------------------------------------------
function retornaUsuario() {
    $att.ajax({
		url  : 'usuario/verificaUser.php',
		type : 'POST',
		data : { consulta : 'S' } ,
		success: function( r ) {
					retorno = r.split('|');	
      					$att('#conectar').fadeOut(250).show()
					    .html("<a href='#'><div id='conectar'>"+retorno[1]+"</div></a>").fadeIn(300);
                }
    });
    return retorno[1];
}

function valida_login() {
   $att('#ajjax').show().html( '<img src="imgs/vwe.gif">' )
			.load( 'conexao/conectar.php', { login_mail: $('#login_mail').val(), login_pwd:$('#login_pwd').val() },
				      function(r) {
					    retorno = r.split('|');
	   					if ( retorno[0]==0 ){
							$att('#conectar').fadeOut(250).show()
						    .html("<a href='#'><div id='conectar'>"+retorno[1]+"</div></a>").fadeIn(300);
							fecha_login();
					    } else {
							$att('#message').css('display', 'block').html( retorno[0] );
						}
		       }
			);
 } 
 

function destruir_sessao() {
		$att.ajax({
			url  : 'conexao/destruir.php',
			type : 'POST',
			data : { destruir: 1 } , 
			success: function( retorno ) {
				if (retorno == 0) {
					$att('#message').css('display', 'block').html('Fechando Sess&atilde;o');
					$att('#conectar').fadeOut(250).show()
						.html("<a href='#' class='login'><div id='conectar'>Logar</div></a>") 
						.fadeIn(300);
					fecha_login();	
				}  
			}
        });
}
//--------------------------------------------------------------------------------------------
function carga() {
alert('Carregando... Modulo!');
}
