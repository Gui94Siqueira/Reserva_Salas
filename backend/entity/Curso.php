<?php

    class Curso {
        private $id;
        private $nome;
        private $sigla;
        private $subArea_Id;

        public function __construct($id, $nome, $sigla, $subArea_Id) {
            $this->id = $id;
            $this->nome = $nome;
            $this->sigla = $sigla;
            $this->subArea_Id = $subArea_Id;
        }

        // GETTERS

        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getSigla() {
            return $this->sigla;
        }

        public function getSubarea_Id() {
            return $this->subArea_Id;
        }


        // SETTERS
    }

?>