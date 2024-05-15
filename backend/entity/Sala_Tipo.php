<?php
class Sala_tipo {
    private $id;
    private $tipo;

    public function __construct($id, $tipo)
    {
        $this->id = $id;
        $this->tipo = $tipo;
    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }


    public function getTipo()
    {
        return $this->tipo;
    }

    //SETTERS
}
