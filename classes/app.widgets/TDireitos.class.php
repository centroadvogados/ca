<?php
/**
 * classe TDireitos
 * Gerencia uma direitos de uma sessão 
 */
class TDireitos
{
    private $u_nivel;
	private $g_nivel;
	
    /* registra sessão atual */
    function __construct()
    {
        session_start();
    }
    
    /* Verifica sessao Ativada */
    function ssTime( $u_nivel, $g_nivel)
    {
		if ( isset( $_SESSION['sessiontime'] ) ) {
		    if ( $_SESSION['usu_nivel']<=$u_nivel ) {
				if ( $_SESSION['grup_nivel']<= $g_nivel ) {
					return true;
				}
			}        			
		} else {
			return false;
		}
    }
	
     /* Libera sessao */
    function freeSession()
    {
        $_SESSION = array();
        session_destroy();
    }
}
?>
