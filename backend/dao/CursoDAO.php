<?php
require_once "config/Database.php";
require_once "BaseDAO.php";
require_once "entity/Curso.php";

class CursoDAO implements BaseDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM Curso WHERE Id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $curso = $stmt->fetch(PDO::FETCH_ASSOC);

            return $curso ?
                new Curso(
                    $curso['Id'],
                    $curso['Nome'],
                    $curso['Sigla'],
                    $curso['SubArea_ID']
                )
                : null;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAll()
    {
        try {
            $sql = "SELECT * FROM curso";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(function ($curso) {
                return new Curso(
                    $curso['Id'],
                    $curso['Nome'],
                    $curso['Sigla'],
                    $curso['SubArea_ID']
                );
            }, $cursos);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function create($curso)
    {
        try {
            $sql = "INSERT INTO curso (Id, Nome, Sigla, SubArea_ID) VALUES
                (null, :nome, :sigla, :subarea_id)";

            $stmt = $this->db->prepare($sql);

            // Bind parameters by reference
            $nome = $curso->getNome();
            $sigla = $curso->getSigla();
            $subarea = $curso->getSubarea();


            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sigla', $sigla);
            $stmt->bindParam(':subarea_id', $subarea);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($curso)
    {
        try {
            $existingCurso = $this->getById($curso->getId());
            if (!$existingCurso) {
                return false; // Retorna falso se o usuário não existir
            }

            $sql = "UPDATE curso SET Nome = :nome, Sigla = :sigla, SubArea = :subarea WHERE Id = :id";


            $stmt = $this->db->prepare($sql);
            // Bind parameters by reference
            $id = $curso->getId();
            $nome = $curso->getNome();
            $sigla = $curso->getSigla();
            $subarea = $curso->getSubarea();

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sigla', $sigla);
            $stmt->bindParam(':subarea_id', $subarea);


            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM curso WHERE Id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
