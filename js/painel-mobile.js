/* Funcoes Jquery implementada em fevereiro de 2015 */

var $att    	= jQuery.noConflict(); 
var tempo   	= new Number();

//----------------------------------------------------------------------------------------------------
// Valor setado na rotina valida_usuario.php
var carrega = 1440; //document.write("<?php echo $_SESSION['sessiontime'];?>"); //estabelece tempo da sessão
//----------------------------------------------------------------------------------------------------

$att(document).ready( function($) {
	
/*
	$(function() { // Movimentacao da Janela
		$( "#login" ).draggable();
		$( "#registro" ).draggable();
    });
*/
	// Aguarda Carregamento da Janela
	$(window).load(function() {	// Animacao carregamento de tela
		$(".se-pre-con").fadeOut("slow");
	});

	//$att('#login').css('display', 'block').load('usuario/login.php');

	$att('#slide1').load('Slideshow/slideshow.html');
		
	$att('.login').click(function(e) {
		$att('#fundo1').css('display', 'block');
		$att('#login').css('display', 'block')
	    .load('usuario/login.php');
	});

	$att('.tabela').click(function(e) {
		$att('#fundo1').css('display', 'block');
		$att('#registro').css('display', 'block')
	    .load('forms/frmTabela.php');
	});
	
	$att('.listta').click(function(e) {
		$att('#fundo1').css('display', 'block');
		$att('#tabela').css('display', 'block')
	    .load('forms/listta/lstLista.php', {  param: 1 }); /* 1- Cadastros */	
	});
	
	$att('.immoveis').click(function(e) {
		$att('#fundo1').css('display', 'block');
		$att('#tabela').css('display', 'block')
	    .load('forms/imoveis/frmImoveis.php', {  param:7, modulo:0, codgru:0 }); /* 7- Imoveis */	
	});
	
	$att('.btn_x').live('click', function(e){// Pagina 2
	    e.preventDefault();
		limpaCampos();
	});

	$att('.volta_x').live('click', function(e){// Pagina 3
	    e.preventDefault();
	  $att('#login').fadeOut("slow");
	});

	$att('.tabela').hover(

	);

});// JavaScript read do Formulario


function fecha_blackbox(n) {
	$att('#login').fadeOut("slow");
	$att('#blackbox').fadeOut("slow");
	$att('.direita').fadeIn("slow");
	$att('#ajjax').hide();
	if(n==1) {
	$att('#fundo1').hide();
	} else if (n==2) {	
	$att('#fundo2').hide();
	}
} 

function fecha_login() {
	$att('#login').fadeOut("slow");
	$att('#blackbox').fadeOut("slow");
	$att('#ajjax').hide();
	$att('#fundo1').hide();
} 

function fecha_consulta() {
	$att('#consulta').fadeOut("slow");
	$att('#ajjax').hide();
	$att('#fundo3').hide();
} 

function fecha_registro(vparam,v2,v3) {
	$att('#registro').fadeOut("fast");
	$att('.direita').fadeIn("fast");
	$att('#fundo2').hide();
	atualizaDiv(vparam,v2,v3);
} 

function fecha_tabela() {
	$att('#tabela').fadeOut("slow");
	$att('#construcao').fadeOut("slow");
	$att('#fundo1').hide();
} 	

 	
function atualizaDiv(v,v2,v3){
	if(v==3){
		$att('#tabela').load('forms/produtos/frmProdutos.php',{param:v, modulo:v2, codgru:v3});
	} 	
	else if (v==4) {	
		$att('#tabela').load('forms/pedidos/frmPedidos.php',{param:v, produto:v2});
    }
}

//----------------------------------------------------------------------------------------------------------------------------
function clock(n) {
	tempo=n;

	if((tempo - 1) >= 0){                   // Se o tempo não for zerado
		var min = parseInt(tempo/60); 		// Pega a parte inteira dos minutos
		var seg = tempo%60;                 // Calcula os segundos restantes

		if(min < 10){                  		// Formata o número menor que dez, ex: 08, 07, ...
			min = "0"+min;
			min = min.substr(0, 2);
		}
		if(seg <=9){
			seg = "0"+seg;
		}
		// Cria a variável para formatar no estilo hora/cronômetro
		horaImprimivel = min + ':' + seg; 	//JQuery pra setar o valor h/m/s '00:' + min + ':' + seg; 
		// Mostra se tempo <=30 seg
		if(tempo<=180) {	
			$("#campo_contador").html('<img src="imagens/ajax.gif" alt="Carregando">').text(horaImprimivel);				
		}
		
		//----Sensor de Movimentação do Mouse, recarrega o tempo de sessão------------------------------------
		$("div").mousemove(function(){
			tempo=carrega;
		});
		//----------------------------------------------------------------------------------------------------		
		
		--tempo;							// diminui o tempo
		setTimeout('clock(tempo)',1000);	// Define que a função será executada novamente em 1000ms = 1 segundo
	
	} else { // Quando o contador zerar, executará esta ação.
		$.ajax({
			url  : 'usuario/destruir.php',
			type : 'POST',
			data : { destruir: 1 } , 
			success: function( retorno ) {
				if (retorno == 0) {
					document.location.reload();
				}  
			}
        });
 	}
}
//----------------------------------------------------------------------------------------------------

function novo_registro( v1, v2, vparam, modulo ) {
		
	if (vparam==1) {
		vform='listta/frmCadastro.php';
	} else if (vparam==2) { 
		vform='';	
	} else if (vparam==3) {
		vform=''; 
		var n=2;
	} else if (vparam==4) {
		vform='';
	} else if (vparam==5) {
		vform='pedidos/frmNovoPedido.php';
		var n=2;	
	} else {	
		vform='listta/frmCadastro.php';
    }
	
	$att('.direita').fadeOut("slow");
	$att('#fundo2').css('display', 'block');
		$att(this).html('<center><br><br><img src="imgs/ajax3.gif" alt="consultando"></center>')
			 .load( 'conexao/direitos.php', {  acao: 1, modulo : modulo },
				function(r) {
					direitos = r.split('|');
						if ( direitos[13]==0 ) {
							$att('#registro').css('display', 'block')
							.load('forms/'+vform ,{ id: v1, objeto:v2, param:vparam, modulo:modulo });
							
						} else {
							$att('#blackbox').css('display', 'block')
							 .load('conexao/msgusuario.php',{ nivel:n }); 	
							
						}
				}
			 );         
}


function abre_registro( v1, v2, vparam, modulo ) {
	
	retorno = v2.split('|');
	
	if (vparam==1) {
		vform='listta/frmCadastro.php';
	} else if (vparam==2) { 
		vform='colaboradores/frmColaborador.php';	
	} else if (vparam==3) {
		vform='produtos/frmProduto.php'; 
		var n=2;
	} else if (vparam==4) {
		vform='pedidos/frmPedido.php'; 
	} else if (vparam==5) {
		vform='pedidos/frmIdentificacao.php';
        var n=2; 		
    } else if (vparam==6) {
		vform='processos/frmProcesso.php';
        var n=2; 			
   } else if (vparam==7) {
		vform='imoveis/frmImovel.php';
        var n=2; 						
	} else {	
		vform='listta/frmCadastro.php';
    }
	
	$att('.direita').fadeOut("slow");
	$att('#fundo2').css('display', 'block');
		$att(this).html('<center><br><br><img src="../imgs/ajax3.gif" alt="consultando"></center>')
			 .load( 'conexao/direitos.php', {  acao: 1, modulo: modulo },
				function(r) {
					direitos = r.split('|');
						if ( direitos[13]==0 ) {
							$att('#registro').css('display', 'block')
							.load('forms/'+vform ,{ id: v1, objeto:v2, param:vparam, modulo:modulo });							
						} else {
							$att('#blackbox').css('display', 'block')
							 .load('conexao/msgusuario.php',{ nivel:n }); 	
						}
				}
			 );         
}


function grava_registro( vparam ) {
    if (vparam==1){
		
	} else if (vparam==5) {
		vchave =$('#pedi_nf_chave').val();
		vcodigo=$('#pedi_codigo').val();
 		$.ajax({
			url  : 'forms/pedidos/gravaPedido.php',
			type : 'GET',
		    data :{ chave:vchave, pedi_codigo:vcodigo } , 
			dataType: 'html',
            contentType: 'application/html; charset=utf-8',
			async: true,
			success: function( r ) {
				var ret = r;
				//ret = r.split('|');
//alert(ret);				
                if ( ret[0] ==0 ){
					$att('#fundo3').css('display', 'block');
					$att(this).html('<center><br><br><img src="imgs/ajax3.gif" alt="Gravando"></center>')
						.load( 'forms/pedidos/insPedido.php', {  modulo: vparam, dados : ret },
							function(r) {
								//retorno = r.split('|');
								var retorno = r;
			
								if ( retorno[0]==0 ) {
									$att(".avisa").css('display','block').html("<b>Registro Gravado, com Sucesso. </b>");
									$att('#fundo3').css('display', 'none');
									$att("#submit").attr('disabled',true);
								} else if ( retorno[0]==1 ){
									$att(".avisa").css('display','block').html("<b>Verifique Arquivo !! </b>");
									$att('#fundo3').css('display', 'none');
									$att("#submit").attr('disabled',true);
								} else {
									$att(".avisa").css('display','block').html("<b>Falha na Grava\u00e7\u00e3o, verifique! </b>");
									$att('#fundo3').css('display', 'none');
									$att("#submit").attr('disabled',true);
								}
alert(retorno);                        							
							}
						);
					
				} else {
						
					if ( ret[0] ==1 ){
						$att(".avisa").css('display','block').html("<b>Dado Ja Registrado, verifique..! </b>");
						$att("#pedi_nf_chave").focus();
					} else {
						$att(".avisa").css('display','block').html("<b>Algo errado, verifique..! </b>");
						$att("#pedi_nf_chave").focus();
					} 									
				}
			  
			}, error: function() {
			 
			  alert('Falha na Operacao!');
			}
        });

				
				
	
	} else {	
	alert('Grava Registro Parametro '+vparam)
    }	
}


function busca_cidades(){
      var estado = $att('#estado').val();  //codigo do estado escolhido
      //se encontrou o estado
      if(estado){
        var url = '../cidades/busca_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD
		$att.get(url, function(retorno) {
		  $att('#cidade').removeAttr('disabled');	
          $att('#cidade').html(retorno);  //coloca o retorno da requisicao
        });
      }
}	


function busca_telefones(){
      var telefone = $att('#telefone').val();  //codigo do telefone escolhido
	  if(telefone){//se encontrou o telefone
        var url = 'busca_telefones.php?codfone='+telefone;  
		$att.get(url, function(retorno) {
		  $att('#telefone').removeAttr('disabled');	
          $att('#telefone').html(retorno);  //coloca o retorno da requisicao
        });
      }
}	

//----------------------------------------------------------------------------------------------------
var Direitos = function() {}; //direitos de Usuarios
Direitos.prototype = {
    getDireitos : function() {
		var arDireitos= [this.id, this.email, this.senha, this.login, this.nome, this.usu_nivel, this.usu_grup_id, 
						 this.usu_status, this.grup_ds, this.grup_nivel, this.dt_acesso, this.sessiontime ];
        return arDireitos;
    },
    setDireitos : function(id, email, senha, login, nome, usu_nivel, usu_grup_id, usu_status, grup_ds, grup_nivel, dt_acesso, sessiontime) {
        this.id 	= id;
		this.email	= email;
        this.senha 	= senha;
		this.login	= login;
		this.nome	= nome ;
		this.usu_nivel	=	usu_nivel
		this.usu_grup_id=	usu_grup_id;
		this.usu_status	=	usu_status;
		this.grup_ds	=	grup_ds;
		this.grup_nivel	=	grup_nivel;
		this.dt_acesso	=	dt_acesso;
		this.sessiontime=	sessiontime;
    }
};

var d = new Direitos();
//---------------------------------------------------------------------------------------------------- 
var Alertar = function() {}; //direitos Alertar
Alertar.prototype = {
    getAlertar : function() {
		var arAlertar= [ this.param1 ];
		$att('#masscara1').css({ width : $att(document).width(),
			height: $att(document).height()}).appendTo('body').show();
		$att('#registro1').show().load('alertar.php', function(e){
			$att('#registro1').append('<div class="linnha">'+arAlertar[0]+'</div>');	
		});
    },
    setAlertar : function(param1) {
        this.param1 = param1;
    }
};
var al = new Alertar();
//----------------------------------------------------------------------------------------------

function label_pessoa(v) {
  //document.formulario.pessoa.disabled = true;
	if ( v=='J' ) {
      $att('#doc1').text('CNPJ');
	  $att('#doc2').text('IE');
	 
    } else if( v=='F' ) {
	  $att('#doc1').text('CPF');
	  $att('#doc2').text('RG');
	 
	}  
}

function valida_campo_cnpj(v) {
	var e = $att('input:radio[name=pessoa]:checked').val(); 
        var v = $att('input:text[name=cnpj]').val(); 
        var url = 'forms/validacpfcnpj.php?parametro='+v;
		$att.get(url, function(ret) {
			if ( e=='J' && ret=='CPF' ) {
 				  $att('#doc1').text('CPF');
				  $att('#doc2').text('RG');
				  //$('input:radio[name=pessoa]').val('F').prop('checked', true);
			} else if( e=='F' && ret=='CNPJ' ) {
				  $att('#doc1').text('CNPJ');
				  $att('#doc2').text('IE');
			}  
        });	
	
		
}	

function check_xml(p){
		$.ajax({
			url  : 'forms/pedidos/vars.php',
			type : 'GET',
		    data :{chave:p ,} , 
			dataType: 'html',
            contentType: 'application/html; charset=utf-8',
			async: true,
			success: function( r ) {
				var ret;
				ret = r.split('|');
                if ( ret[0] ==0 ){
                    $att("#pedi_nf_chave").attr('disabled',true);
					$att("#pedi_nnf").val(ret[1]).attr('disabled',true);
                    $att("#pedi_nm").val(ret[5]).attr('disabled',true);	
                    $att("#pedi_remetente").val(ret[5]).attr('disabled',true);
					$att("#pedi_destinatario").val(ret[21]).attr('disabled',true);
					
					$att("#pedi_pesob").val(ret[22]).attr('disabled',true);
					$att("#pedi_volume").val(ret[23]).attr('disabled',true);
					$att(".etiq").css("display", "block");
					$att("#etiq1").html( '<h1 class="conteudo">'+$att("#pedi_nnf").val()+'</h1>'+  
										 '<h4 class="conteudo">Dest.:<b>'+$att("#pedi_destinatario").val()+'</b></h4>'+                 
										 '<h4 class="conteudo">Vol. <b>'+$att("#pedi_volume").val()+'</b>'+
										 '  -  Peso Bruto :<b>'+$att("#pedi_pesob").val()+'</b></h4>'
					);
					$att(".avisa").css('display','none').html("<b>Registro n&atilde;o encontrado!</b>");
					
				} else {
					$att("#pedi_nf_chave").attr('disabled',false);
					$att("#pedi_id_cli").attr('disabled',true);
					$att("#pedi_nnf").val(ret[1]).attr('disabled',true);
                    $att("#pedi_nm").val(ret[5]).attr('disabled',true);	
                    $att("#pedi_remetente").val(ret[5]).attr('disabled',true);
					$att("#pedi_destinatario").val(ret[21]).attr('disabled',true);
					$att("#pedi_pesob").val(ret[22]).attr('disabled',true);
					$att("#pedi_volume").val(ret[23]).attr('disabled',true);
					$att(".avisa").css("display", "block").html("<b>Registro n&atilde;o encontrado!</b>");
										
				}
			  
			},
			error: function() {
			  alert("erro na verificacao. Tente novamente por favor! ");
			}
        });
			
}

 
 