<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

require_once("../models/RecetaModel.php");

class BuscarRecetaRut
{
    public $rut;

    public function __construct()
    {
        $this->rut = $_POST['rut'];
    }

    public function buscarRecetaRut()
    {

        session_start();
        $modelo = new RecetaModel();
        $arr = $modelo->buscarRecetaXRut($this->rut);
        $_SESSION["receta_rut"] = $arr;

        header("Location: ../index.php");
    }
}

$obj = new BuscarRecetaRut();
$obj->buscarRecetaRut();
