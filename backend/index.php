<?php
    require_once "dao/ReservaDAO.php";
    require_once "entity/Reserva.php";

    $reservaDAO = new ReservaDAO();
    $reserva = new Reserva(null, 1, 1, "Livre", null, null, "seg/ter");

    echo $reservaDAO->create($reserva);
    print_r($reservaDAO->getAll());
    // print_r($reserva);
?>