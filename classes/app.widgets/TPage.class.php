<?php
/**
 * classe TPage
 * Classe para controle do fluxo de execuчуo
 */
class TPage extends TElement
{
    /**
     * mщtodo __construct()
     *
     */
    public function __construct()
    {
        parent::__construct('html');
    }
    
    /**
     * mщtodo show()
     * Exibe o conteњdo da pсgina
     */
    public function show()
    {
        $this->run();
        parent::show();
    }
    
    /**
     * mщtodo run()
     * Executa determinado mщtodo de acordo com
     *  os parтmetros recebidos
     */
    public function run()
    {
        if ($_GET)
        {
            $class  = $_GET['class'];
            $method = $_GET['method'];
            
            if ($class)
            {
                $object = $class == get_class($this) ? $this : new $class;
                if (method_exists($object, $method))
                {
                    call_user_func(array($object, $method), $_GET);
                }
            }
            else if (function_exists($method))
            {
                call_user_func($method, $_GET);
            }
        }
    }
}
?>