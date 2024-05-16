<?php
require_once "dao/ReservaDAO.php";
require_once "entity/Reserva.php";
require_once "services/homeaction.php";

//$reservaDAO = new ReservaDAO();
$dataInicio = date("Y-m-d H:i:s");
$datafim  = date("Y-m-d H:i:s");
//$reserva = new Reserva(4, 1, 2, "Livre", $dataInicio, $datafim, "");

//print_r($reservaDAO->create($reserva));
//print_r($reservaDAO->delete(2));
// print_r($reserva);
?>
