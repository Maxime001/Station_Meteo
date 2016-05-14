<?php


/**
 * Classe formulaire gérant les formulaires
 */
class Form {
     /**
     * @var array Données utilisées par le formualaire
     * */
    protected $data;
    /*
     *
     */
    public $surround = 'span';
    /*
     * 
     */
    public function __construct($data = array()){
        $this->data = $data;
    }
    /*
     * @param $html string Code HTML à entourer
     * @return string
     */
    protected function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }
    /*
     *
     */
    protected function getValue($index){
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }
    /*
     *
     */
    public function input($name, $type, $class, $placeholder,$id){
         return $this->surround(
             '<input id="'.$id.'" placeholder="' . $placeholder . '" class="'.$class.'" type="'.$type.'" name="' . $name . '"value = "' . $this->getValue($name) . '">');
    }
    /*
     *
     */
    public function submit($class){
        return $this->surround('<button class="'.$class.'" type="submit">Envoyer</button>');
    }
}
