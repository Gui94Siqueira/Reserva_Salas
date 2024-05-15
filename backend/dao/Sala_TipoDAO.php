<?php
    require_once "config/Database.php";
    require_once "BaseDAO.php";
    require_once "entity/Sala_tipo.php";

    class Sala_tipo implements BaseDAO {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function getById($id) {
            try {
                $sql = "SELECT * FROM tipo_sala WHERE Id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $sala_tipo = $stmt->fetch(PDO::FETCH_ASSOC);

                return $sala_tipo ?
                    new Turma($sala_tipo['Id'],
                              $sala_tipo['Tipo'])
                    : null;

            } catch (PDOException $e) {
                return false;
            }
        }

        public function getAll() {
            try {
                $sql = "SELECT * FROM tipo_sala";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();

                $salas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return array_map(function ($sala_tipo) {
                    return new Turma($sala_tipo['Id'],
                                     $sala_tipo['Tipo']);
                }, $salas);
            } catch (PDOException $e) {
                return false;
            }
        }

        public function create($sala_tipo) {
            try {
                $sql = "INSERT INTO tipo_sala (Id, Tipo) VALUES
                (null, :tipo)";

                $stmt = $this->db->prepare($sql);

                // Bind parameters by reference
                $tipo = $sala_tipo->getTipo();
                

                $stmt->bindParam(':tipo', $tipo);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function update($sala_tipo) {
            try{
                $existingSala = $this->getById($sala_tipo->getId());
                    if(!$existingSala) {
                        return false; // Retorna falso se o usuário não existir
                    }
                    
                    $sql = "UPDATE tipo_sala SET Tipo_ID = :tipo_id, Capacidade = :capacidade, numero = :numero WHERE Id = :id";
                    
    
                    $stmt = $this->db->prepare($sql);
                    // Bind parameters by reference
                    $id = $sala_tipo->getId();
                    $tipo = $sala_tipo->getTipo();
    
                    $stmt->bindParam(':id', $id);
                    $stmt->bindParam(':tipo_id', $tipo);
    
                    $stmt->execute();
    
                    return true;
                } catch (PDOException $e) {
                    return false;
                }
        }

        public function delete($id) {
            try {
                $sql = "DELETE FROM tipo_sala WHERE Id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
           
            } catch (PDOException $e) {
                return false;
            }
        }

    }