<?php

namespace controllers;

use models\ClienteModel;

require_once("../models/ClienteModel.php");

class BuscarClienteRut
{
    public $rut;

    public function __construct()
    {
        $this->rut = $_POST['rut'];
    }

    public function buscar()
    {
        session_start();
        $model = new ClienteModel();
        $arr = $model->buscarClienteXRut($this->rut); //[{...}] - []

        if (count($arr) == 0) {
            $_SESSION['error'] = "Rut no encontrado, favor registrar cliente";
            header("Location: ../insert_receta.php");
            return;
        }
        $_SESSION['cliente'] = $arr[0];
        header("Location: ../insert_receta.php");
    }
}

$obj = new BuscarClienteRut();
$obj->buscar();
