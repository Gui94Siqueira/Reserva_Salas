<?php
    require_once "config/Database.php";
    require_once "BaseDAO.php";
    require_once "entity/Turma.php";

    class Turma implements BaseDAO {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function getById($id) {

        }

        public function getAll() {

        }

        public function create($entity) {

        }

        public function update($entity) {

        }

        public function delete($id) {
            
        }

    }
?>