
function lstProdutos(p) {
	    codgru = $att('#gruproduto option:selected').val();
		$att('#tabbela0').html('<center><br><br><img src="imgs/ajax3.gif" alt="consultando"></center>')
			.load('forms/produtos/lstProdutos.php', {grupo: codgru , param: p }, 
				function(data){
					$att('#tabbela1').html().slideDown('slow')
						.html(data).slideUp('slow');																
													
				});
}
//----------------------------------------------------------------------------------
/**
* Utilizada em maio de 2013
* 2016 Modulo de produtos-mobile 
*/
function detalhe( cod_id , v_modulo )
 {
          $att.post('forms/produtos/detalhe.php',{ itm : cod_id , modulo : v_modulo }, function(data){
            $att('#mascara').css({ width : $(document).width(), height: $att(document).height()})
            .appendTo('body').show(20);

            $att('#detalhe').css({ left: ($att(document).width()/2 - 345), top : ($att(document).height()/2 - 500) })
            .show(10).html(data).slideDown('slow');
 	  });  
 } 
