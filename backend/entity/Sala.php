<?php
    class Sala {
        private $id;
        private $numero;
        private $tipo;
        private $capacidade;
        
        public function __construct($id, $numero,  $tipo, $capacidade, ) {
            $this->id = $id;
            $this->numero = $numero;
            $this->tipo = $tipo;
            $this->capacidade = $capacidade;
            
        }

        // GETTERS

        public function getId() {
            return $this->id;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function getCapacidade() {
            return $this->capacidade;
        }

        // SETTERS
    }
?>