<?php
require_once 'config/database.php';
require_once 'BaseDAO.php';
require_once 'entity/Docente.php';
 
class docenteDAO implements BaseDAO {
    private $db;
 
    public function __construct() {
        $this->db = Database::getInstance();
    }
 
    public function getByid($id) {
        try {
            $sql = "SELECT * FROM docente WHERE Id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $docente = $stmt->fetch(PDO::FETCH_ASSOC);

            return $docente ?
                new Docente($docente['Id'],
                          $docente['Nome'])
                : null;

        } catch (PDOException $e) {
            return false;
        }
    }
 
    public function getAll() {
        try {
            $sql = "SELECT * FROM docente";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $docentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(function ($docente) {
                return new Docente($docente['Id'],
                                 $docente['Nome']);
            }, $docentes);
        } catch (PDOException $e) {
            return false;
        }
    }
        
 
    public function create($docente) {
        try {
            $sql = "INSERT INTO docente (Id, Nome) VALUES (null, :nome)";

                $stmt = $this->db->prepare($sql);

                // Bind parameters by reference
                $nome = $docente->getNome();
                
                $stmt->bindParam(':nome', $nome);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
    }
 
    public function update($docente) {
        try {
                $existingDocente = $this->getById($docente->getId());
                if(!$existingDocente) {
                    return false; // Retorna falso se o usuário não existir
                }
                
                $sql = "UPDATE docente SET Nome = :nome WHERE Id = :id";
                

                $stmt = $this->db->prepare($sql);
                // Bind parameters by reference
                $id = $docente->getId();
                $nome = $docente->getNome();

                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':tipo_id', $nome);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
    }
 
    public function delete($id) {
        try {
            $sql = "DELETE FROM docente WHERE Id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
       
        } catch (PDOException $e) {
            return false;
        }
    }
}
   
 
?>