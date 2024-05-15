<?php
    require_once "dao/ReservaDAO.php";
    require_once "entity/Reserva.php";

    $reservaDAO = new ReservaDAO();
    $reserva = new Reserva(4, 1, 1, "Livre", null, null, "seg/qua");

    //print_r($reservaDAO->(4));
    print_r($reservaDAO->delete(2));
    // print_r($reserva);
?>