<?php
/**
 * class TDataGridColumn
 * Representa uma coluna de uma listagem
 */
class TDataGridColumn
{
    private $name;
    private $label;
    private $align;
    private $width;
    private $action;
    private $transformer;
    
    /**
     * mйtodo __construct()
     * Instancia uma coluna nova
     * @param  $name  = nome da coluna no banco de dados
     * @param  $label = rуtulo de texto que serб exibido
     * @param  $align = alinhamento da coluna (left, center, right)
     * @param  $width = largura da coluna (em pixels)
     */
    public function __construct($name, $label, $align, $width)
    {
        // atribui os parвmetros аs propriedades do objeto
        $this->name  = $name;
        $this->label = $label;
        $this->align = $align;
        $this->width = $width;
    }
    
    /**
     * mйtodo getName()
     * Retorna o nome da coluna no banco de dados
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * mйtodo getLabel()
     * Retorna o nome do rуtulo de texto da coluna
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * mйtodo getAlign()
     * Retorna o alinhamento da coluna (left, center, right)
     */
    public function getAlign()
    {
        return $this->align;
    }
    
    /**
     * mйtodo getWidth()
     * Retorna a largura da coluna (em pixels)
     */
    public function getWidth()
    {
        return $this->width;
    }
    
    /**
     * mйtodo setAction()
     * Define uma aзгo a ser executada quando o usuбrio
     * clicar sobre o tнtulo da coluna
     * @param  $action = objeto TAction contendo a aзгo
     */
    public function setAction(TAction $action)
    {
        $this->action = $action;
    }
    
    /**
     * mйtodo getAction()
     * Retorna a aзгo vinculada а coluna
     */
    public function getAction()
    {
        // verifica se a coluna possui aзгo
        if ($this->action)
        {
            return $this->action->serialize();
        }
    }
    
    /**
     * mйtodo setTransformer()
     * Define uma funзгo (callback) a ser aplicada sobre
     * todo dado contido nesta coluna
     * @param  $callback = funзгo do PHP ou do usuбrio
     */
    public function setTransformer($callback)
    {
        $this->transformer = $callback;
    }

    /**
     * mйtodo getTransformer()
     * Retorna a funзгo (callback) aplicada а coluna
     */
    public function getTransformer()
    {
        return $this->transformer;
    }
}
?>