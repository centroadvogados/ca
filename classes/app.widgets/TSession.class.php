<?php
/**
 * classe TSession
 * Gerencia uma seção com o usuário
 */
class TSession
{
    /**
     * método construtor
     * inicializa uma seção
     */
    function __construct()
    {
        session_start();
    }
    
    /**
     * método setValue()
     * Armazena uma variável na seção
     * @param  $var   = Nome da variável
     * @param  $value = Valor
     */
    function setValue($var, $value)
    {
        $_SESSION[$var] = $value;
    }
    
    /**
     * método getValue()
     * Retorna uma variável da seção
     * @param  $var   = Nome da variável
     */
    function getValue($var)
    {
        return $_SESSION[$var];
    }
    
    /**
     * método freeSession()
     * Destrói os dados de uma seção
     */
    function freeSession()
    {
        $_SESSION = array();
        session_destroy();
    }
}
?>
