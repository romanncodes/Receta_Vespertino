<?php

namespace controllers;

class NuevaReceta
{

    public function __construct()
    {
        session_start();
        unset($_SESSION['data']);
        unset($_SESSION['error_tipo_lente']);
        unset($_SESSION['error_rut_cliente']);
        unset($_SESSION['error_tipo_lente']);
        unset($_SESSION['cliente']);
        unset($_SESSION['success']);
        header('Location: ../insert_receta.php');
    }
}

$obj = new NuevaReceta();
