<?php

    class Turma {
        private $id;
        private $docente_id;
        private $curso_id;
        private $cod_turma;
        private $periodo;

        public function __construct($id, $docente_id, $curso_id, $cod_turma, $periodo) {
            $this->id = $id;
            $this->docente_id = $docente_id;
            $this->curso_id = $curso_id;
            $this->cod_turma = $cod_turma;
            $this->periodo = $periodo;
        }

        // GETTERS

        public function getId() {
            return $this->id;
        }

        public function getDocente_id() {
            return $this->docente_id;
        }

        public function getCurso_id() {
            return $this->curso_id;
        }

        public function getCod_turma() {
            return $this->cod_turma;
        }

        public function getPeriodo() {
            return $this->periodo;
        }


        // SETTERS
    }
?>