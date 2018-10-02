<?php
/**
 * classe TCheckGroup
 * Classe para exibição um grupo de CheckButtons
 */
class TCheckGroup extends TField
{
    private $layout = 'vertical';
    private $items;

    /**
     * método setLayout()
     * Define a direção das opções (vertical ou horizontal)
     */
    public function setLayout($dir)
    {
        $this->layout = $dir;
    }
    
    /* método addItems($items)
     * adiciona itens ao check group
     * @param  $items = um vetor indexado de itens
     */
    public function addItems($items)
    {
        $this->items = $items;
    }
    
    /**
     * método show()
     * exibe o widget na tela
     */
    public function show()
    {
        if ($this->items)
        {
            // percorre cadauma das opções do rádio
            foreach ($this->items as $index => $label)
            {
                $button = new TCheckButton("{$this->name}[]");
                $button->setValue($index);
                if (@in_array($index, $this->value))
                {
                    $button->setProperty('checked', '1');
                }
                $button->show();
                $obj = new TLabel($label);
                $obj->show();
                
                if ($this->layout == 'vertical')
                {
                    // exibe uma tag de quebra de linha
                    $br = new TElement('br');
                    $br->show();
                    echo "\n";
                }
            }
        }
    }
}
?>