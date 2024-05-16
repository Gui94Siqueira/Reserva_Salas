<?php
    require_once "config/Database.php";
    require_once "BaseDAO.php";
    require_once "entity/Reserva.php";

    class ReservaDAO implements BaseDAO {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function getById($id) {
            try {
                $sql = "SELECT * FROM reserva WHERE Id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

                return $reserva ?
                    new Reserva($reserva['Id'],
                                $reserva['Sala_ID'],
                                $reserva['Turma_ID'],
                                $reserva['Status'],
                                $reserva['Data_Inicio'],
                                $reserva['Data_FIM'],
                                $reserva['Dias_Semana'])
                    : null;

            } catch (PDOException $e) {
                return false;
            }
        }

        public function getAll() {
            try {
                $sql = "SELECT * FROM reserva";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();

                $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return array_map(function ($reserva) {
                    return new Reserva($reserva['Id'],
                                        $reserva['Sala_ID'],
                                        $reserva['Turma_ID'],
                                        $reserva['Status'],
                                        $reserva['Data_Inicio'],
                                        $reserva['Data_FIM'],
                                        $reserva['Dias_Semana']);
                }, $reservas);
            } catch (PDOException $e) {
                return false;
            }
        }
        
        public function create($reserva) {
            try {
                $sql = "INSERT INTO reserva (Id, Sala_ID, Turma_ID, Status, Data_Inicio, Data_FIM, Dias_Semana) VALUES
                (null, :sala_id, :turma_id, :status, :data_inicio, :data_fim, :diasemana)";

                $stmt = $this->db->prepare($sql);

                // Bind parameters by reference
                $sala_id = $reserva->getSala_id();
                $turma_id = $reserva->getTurma_id();
                $status = $reserva->getStatus();
                $data_inicio = $reserva->getData_inicio();
                $data_fim = $reserva->getData_fim();
                $dias_semana = $reserva->getDias_semana();

                $stmt->bindParam(':sala_id', $sala_id);
                $stmt->bindParam(':turma_id', $turma_id);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':data_inicio', $data_inicio);
                $stmt->bindParam(':data_fim', $data_fim);
                $stmt->bindParam(':diasemana', $dias_semana);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function update($reserva) {
            try {
                $existingReserva = $this->getById($reserva->getId());
                if(!$existingReserva) {
                    return false; // Retorna falso se o usuário não existir
                }
                
                $sql = "UPDATE reserva SET Sala_ID = :sala_id, Turma_ID = :turma_id, Status = :status, 
                Data_Inicio = :data_inicio, Data_FIM = :data_fim, Dias_Semana = :dias_semana
                WHERE Id = :id";
                

                $stmt = $this->db->prepare($sql);
                // Bind parameters by reference
                $id = $reserva->getId();
                $sala_id = $reserva->getSala_id();
                $turma_id = $reserva->getTurma_id();
                $status = $reserva->getStatus();
                $data_inicio = $reserva->getData_inicio();
                $data_fim = $reserva->getData_fim();
                $dias_semana = $reserva->getDias_semana();

                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':sala_id', $sala_id);
                $stmt->bindParam(':turma_id', $turma_id);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':data_inicio', $data_inicio);
                $stmt->bindParam(':data_fim', $data_fim);
                $stmt->bindParam(':dias_semana', $dias_semana);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function delete($id) {
            try {
                $sql = "DELETE FROM reserva WHERE Id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
           
            } catch (PDOException $e) {
                return false;
            }
        }
    }

?>