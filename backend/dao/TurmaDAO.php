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
            try {
                $sql = "SELECT * FROM turma WHERE Id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $turma = $stmt->fetch(PDO::FETCH_ASSOC);

                return $turma ?
                    new Turma($turma['Id'],
                                $turma['Docente_ID'],
                                $turma['Curso_ID'],
                                $turma['Cod_Turma'],
                                $turma['Periodo'],
                                $turma['Ativo'])
                    : null;

            } catch (PDOException $e) {
                return false;
            }
        }

        public function getAll() {
            try {
                $sql = "SELECT * FROM turma";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();

                $turmas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return array_map(function ($turma) {
                    return new Turma($turma['Id'],
                                        $turma['Sala_ID'],
                                        $turma['Turma_ID'],
                                        $turma['Status'],
                                        $turma['Data_Inicio'],
                                        $turma['Data_FIM'],
                                        $turma['Dias_Semana']);
                }, $turmas);
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