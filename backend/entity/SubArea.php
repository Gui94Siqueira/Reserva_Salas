<?php

    class SubArea {
        private $id;
        private $nome;
        private $cor;

        public function __construct($id, $nome, $cor) {
            $this->id = $id;
            $this->nome = $nome;
            $this->cor = $cor;
        }

        // GETTERS

        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getCor() {
            return $this->cor;
        }

        // SETTERS
    }
?>