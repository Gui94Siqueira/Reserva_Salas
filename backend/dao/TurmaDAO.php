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

        public function create($turma) {
            try {
                $sql = "INSERT INTO turma (Id, Docente_ID, Curso_ID, Cod_Turma, Ativo) VALUES
                (null, :docente_id, :curso_id, :cod_turma,:periodo, :ativo)";

                $stmt = $this->db->prepare($sql);

                // Bind parameters by reference
                $docente_id = $turma->getDocente_id();
                $curso_id = $turma->getCurso_id();
                $cod_turma = $turma->getCod_turma();
                $periodo = $turma->getPeriodo();
                $ativo = $turma->getAtivo();

                $stmt->bindParam(':docente_id', $docente_id);
                $stmt->bindParam(':curso_id', $curso_id);
                $stmt->bindParam(':cod_turma', $cod_turma);
                $stmt->bindParam(':periodo', $periodo);
                $stmt->bindParam(':ativo', $ativo);

                $stmt->execute();

                return "reserva cadastrada";
            } catch (PDOException $e) {
                return "erro";
            }
        }

        public function update($turma) {
            try{
            $existingTurma = $this->getById($turma->getId());
                if(!$existingTurma) {
                    return false; // Retorna falso se o usuário não existir
                }
                
                $sql = "UPDATE turma SET Docente_ID = :docente_id, Curso_ID = :curso_id, Cod_turma = :cod_turma, 
                Periodo = :periodo, Ativo = :ativo WHERE Id = :id";
                

                $stmt = $this->db->prepare($sql);
                // Bind parameters by reference
                $id = $turma->getId();
                $docente_id = $turma->getDocente_id();
                $curso_id = $turma->getCurso_id();
                $cod_turma = $turma->getCod_turma();
                $periodo = $turma->getPeriodo();
                $ativo = $turma->getAtivo();

                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':docente_id', $docente_id);
                $stmt->bindParam(':curso_id', $curso_id);
                $stmt->bindParam(':cod_turma', $cod_turma);
                $stmt->bindParam(':periodo', $periodo);
                $stmt->bindParam(':ativo', $ativo);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function delete($id) {
            try {
                $sql = "DELETE FROM turma WHERE Id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
           
            } catch (PDOException $e) {
                return false;
            }
        }

    }
?>