<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

require_once("../models/RecetaModel.php");

class BuscarRecetaId
{
    public $id;

    public function __construct()
    {
        $this->id = $_POST["id"];
    }

    public function carga()
    {
        session_start();
        $modelo = new RecetaModel();
        $arr = $modelo->buscarRecetaXID($this->id);
        $_SESSION["detalle"] = $arr[0];

        header("Location: ../index.php");
    }
}

$obj = new BuscarRecetaId();
$obj->carga();
