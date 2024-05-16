<?php
    class Reserva {
        private $id;
        private $sala_id;
        private $turma_id;
        private $status;
        private $data_Inicio;
        private $data_Fim;

        public function __construct($id, $sala_id, $turma_id, $status, $data_Inicio, $data_Fim) {
            $this->id = $id;
            $this->sala_id = $sala_id;
            $this->turma_id = $turma_id;
            $this->status = $status;
            $this->data_Inicio = $data_Inicio;
            $this->data_Fim = $data_Fim;
        }

        // GETTERS

        public function getId() {
            return $this->id;
        }

        public function getSala_id() {
            return $this->sala_id;
        }

        public function getTurma_id() {
            return $this->turma_id;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getData_inicio() {
            return $this->data_Inicio;
        }

        public function getData_fim() {
            return $this->data_Fim;
        }

        // SETTERS



    }

?>