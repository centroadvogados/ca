<?php
/**
 * classe TTranslation
 * Classe utilitária para tradução de textos
 */
class TTranslation
{
	private static $instance; // instância de TTranslation
    private $lang;            // linguagem destino
    
    /**
     * método __construct()
     * Instancia um objeto TTranslation
     */
	private function __construct()
	{
		$this->messages['en'][] = 'Function';
        $this->messages['en'][] = 'Table';
        $this->messages['en'][] = 'Tool';
        
        $this->messages['pt'][] = 'Função';
        $this->messages['pt'][] = 'Tabela';
        $this->messages['pt'][] = 'Ferramenta';
        
        $this->messages['it'][] = 'Funzione';
        $this->messages['it'][] = 'Tabelle';
        $this->messages['it'][] = 'Strumento';
	}

    /**
     * método getInstance()
     * Retorna a única instância de TTranslation
     */
	public static function getInstance()
	{
        // se não existe instância ainda
		if (empty(self::$instance))
		{
            //instancia um objeto
			self::$instance = new TTranslation;
		}
        // retorna a instância
		return self::$instance;
	}
    
    /**
     * método setLanguage()
     * Define a linguagem a ser utilizada
     * @param  $lang = linguagem (en,pt,it)
     */
	public static function setLanguage($lang)
    {
        $instance = self::getInstance();
        $instance->lang = $lang;
    }
    
    /**
     * método getLanguage()
     * Retorna a linguagem atual
     */
	public static function getLanguage()
    {
        $instance = self::getInstance();
        return $instance->lang;
    }
    
    /**
     * método Translate()
     * Traduz uma palavra para a linguagem definida
     * @param  $word = Palavra a ser traduzida
     */
	public function Translate($word)
    {
        // obtém a instância atual
        $instance = self::getInstance();
        // busca o índice numérico da palavra dentro do vetor
        $key = array_search($word, $instance->messages['en']);
        
        // obtém a linguagem para tradução
        $language = self::getLanguage();
        // retorna a palavra traduzida
        // vetor indexado pela linguagem e pela chave
        return $instance->messages[$language][$key];
    }
}

/**
 * método _t()
 * Fachada para o método Translate da classe Translation
 * @param  $word = Palavra a ser traduzida
 */
function _t($word)
{
	return TTranslation::Translate($word);
}
?>