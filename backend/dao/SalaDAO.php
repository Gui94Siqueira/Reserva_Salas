<?php
    require_once "config/Database.php";
    require_once "BaseDAO.php";
    require_once "entity/Sala.php";

    class Sala implements BaseDAO {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function getById($id) {
            try {
                $sql = "SELECT * FROM sala WHERE Id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $sala = $stmt->fetch(PDO::FETCH_ASSOC);

                return $sala ?
                    new Turma($sala['Id'],
                                $sala['Tipo_ID'],
                                $sala['Capacidade'],
                                $sala['numero'])
                    : null;

            } catch (PDOException $e) {
                return false;
            }
        }

        public function getAll() {
            try {
                $sql = "SELECT * FROM sala";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();

                $salas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return array_map(function ($sala) {
                    return new Turma($sala['Id'],
                                     $sala['numero'],
                                     $sala['Tipo_ID'],
                                     $sala['Capacidade']);
                }, $salas);
            } catch (PDOException $e) {
                return false;
            }
        }

        public function create($sala) {
            try {
                $sql = "INSERT INTO sala (Id, Numero, Tipo_ID, Capacidade) VALUES
                (null, :tipo, :capacidade, :numero)";

                $stmt = $this->db->prepare($sql);

                // Bind parameters by reference
                $tipo = $sala->getNome();
                $capacidade = $sala->getCapacidade();
                $numero = $sala->getNumero();
                

                $stmt->bindParam(':nome', $tipo);
                $stmt->bindParam(':capacidade', $capacidade);
                $stmt->bindParam(':numero', $numero);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function update($sala) {
            try{
                $existingSala = $this->getById($sala->getId());
                    if(!$existingSala) {
                        return false; // Retorna falso se o usuário não existir
                    }
                    
                    $sql = "UPDATE sala SET Tipo_ID = :tipo_id, Capacidade = :capacidade, numero = :numero WHERE Id = :id";
                    
    
                    $stmt = $this->db->prepare($sql);
                    // Bind parameters by reference
                    $id = $sala->getId();
                    $tipo = $sala->getNumero();
                    $capacidade = $sala->getTipo();
                    $numero = $sala->getCapacidade();
    
                    $stmt->bindParam(':id', $id);
                    $stmt->bindParam(':numero', $numero);
                    $stmt->bindParam(':tipo_id', $tipo);
                    $stmt->bindParam(':capacidade', $capacidade);
                    
    
                    $stmt->execute();
    
                    return true;
                } catch (PDOException $e) {
                    return false;
                }
        }

        public function delete($id) {
            try {
                $sql = "DELETE FROM sala WHERE Id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
           
            } catch (PDOException $e) {
                return false;
            }
        }

    }
?>