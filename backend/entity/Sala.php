<?php
    class Sala {
        private $id;
        private $tipo;
        private $capacidade;
        private $numero;
        
        public function __construct($id, $tipo, $capacidade, $numero) {
            $this->id = $id;
            $this->tipo = $tipo;
            $this->capacidade = $capacidade;
            $this->numero = $numero;
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