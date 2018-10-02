<?php
/**
 * classe TField
 * Classe base para constru��o dos widgets para formul�ros
 */
abstract class TField
{
    protected $name;
    protected $size;
    protected $value;
    protected $editable;
    protected $tag;
    
    /**
     * m�todo construtor
     * instancia um campo do formulario
     * @param  $name    = nome interno do campo
     */
    public function __construct($name)
    {
        // define algumas caracter�sticas iniciais
        self::setEditable(true);
        self::setName($name);
        self::setSize(200);
        
        // Instancia um estilo CSS chamado tfield
        // que ser� utilizado pelos campos do formul�rio
        $style1 = new TStyle('tfield');
        $style1->border          = 'solid';
        $style1->border_color    = '#a0a0a0';
        $style1->border_width    = '1px';
        $style1->z_index         = '1';
        
        $style2 = new TStyle('tfield_disabled');
        $style2->border          = 'solid';
        $style2->border_color    = '#a0a0a0';
        $style2->border_width    = '1px';
        $style2->background_color= '#e0e0e0';
        $style2->color           = '#a0a0a0';
        
        $style1->show();
        $style2->show();
        
        // cria uma tag HTML do tipo <input>
        $this->tag = new TElement('input');
        $this->tag->class = 'tfield';   // classe CSS
    }
    
    /**
     * m�todo setName()
     * Define o nome do widget
     * @param  $name    = nome do widget
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * m�todo getName()
     * Retorna o nome do widget
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * m�todo setValue()
     * Define o valor de um campo
     * @param  $value   = valor do campo
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * m�todo getValue()
     * Retorna o valor de um campo
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * m�todo setEditable()
     * Define se o campo poder� ser editado
     * @param  $editable = TRUE ou FALSE
     */
    public function setEditable($editable)
    {
        $this->editable= $editable;
    }

    /**
     * m�todo getEditable()
     * Retorna o valor da propriedade editable
     */
    public function getEditable()
    {
        return $this->editable;
    }
    
    /**
     * m�todo setProperty()
     * Define uma propriedade para o campo
     * @param  $name  = nome da propriedade
     * @param  $valor = valor da propriedade
     */
    public function setProperty($name, $value)
    {
        // $this->tag � um objeto agregado
        // ser� executado o seu m�todo __set()
        // lidando internamente com a propriedade
        $this->tag->$name = $value;
    }
    
    /**
     * m�todo setSize()
     * Define a largura do widget
     * @param  $size    = tamanho em pixels
     */
    public function setSize($size)
    {
        $this->size = $size;
    }
}
?>