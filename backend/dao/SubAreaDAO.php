<?php
    require_once "config/Database.php";
    require_once "BaseDAO.php";
    require_once "entity/SubArea.php";

    class SubArea implements BaseDAO {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function getById($id) {
            try {
                $sql = "SELECT * FROM subarea WHERE Id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $turma = $stmt->fetch(PDO::FETCH_ASSOC);

                return $turma ?
                    new Turma($turma['Id'],
                                $turma['Nome'],
                                $turma['Cor'])
                    : null;

            } catch (PDOException $e) {
                return false;
            }
        }

        public function getAll() {
            try {
                $sql = "SELECT * FROM subarea";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();

                $subareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return array_map(function ($subarea) {
                    return new Turma($subarea['Id'],
                                     $subarea['Nome'],
                                     $subarea['Cor']);
                }, $subareas);
            } catch (PDOException $e) {
                return false;
            }
        }

        public function create($entity) {
            
        }

        public function update($entity) {

        }

        public function delete($id) {
            
        }

    }
?>