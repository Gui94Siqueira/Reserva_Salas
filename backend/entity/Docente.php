<?php

     
class Docente {
    private $id;
    private $nome;
 
    public function __construct($id, $nome) {
        $this-> id = $id;
        $this-> nome = $nome;
    }
 
    // GETTERS
 
    public function getId() {
        return $this->id;
    }
 
   
    public function getNome() {
        return $this->nome;
    }
 
    //SETTERS
}

?>