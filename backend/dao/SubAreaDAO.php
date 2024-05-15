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

        public function create($subarea) {
            try {
                $sql = "INSERT INTO subarea (Id, Nome, Cor) VALUES
                (null, :nome, :cor)";

                $stmt = $this->db->prepare($sql);

                // Bind parameters by reference
                $nome = $subarea->getNome();
                $cor = $subarea->getCor();
                

                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':cor', $cor);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function update($subarea) {
            try{
                $existingSubarea = $this->getById($subarea->getId());
                    if(!$existingSubarea) {
                        return false; // Retorna falso se o usuário não existir
                    }
                    
                    $sql = "UPDATE subarea SET Nome = :nome, Cor = :cor WHERE Id = :id";
                    
    
                    $stmt = $this->db->prepare($sql);
                    // Bind parameters by reference
                    $id = $subarea->getId();
                    $nome = $subarea->getNome();
                    $cor = $subarea->getCor();
    
                    $stmt->bindParam(':id', $id);
                    $stmt->bindParam(':nome', $nome);
                    $stmt->bindParam(':cor', $cor);
    
                    $stmt->execute();
    
                    return true;
                } catch (PDOException $e) {
                    return false;
                }
        }

        public function delete($id) {
            try {
                $sql = "DELETE FROM subarea WHERE Id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
           
            } catch (PDOException $e) {
                return false;
            }
        }

    }
?>