<?php

namespace models;

require_once("Conexion.php");

class ClienteModel
{

    public function buscarClienteXRut($rut)
    {
        $sql = "select * from cliente where rut_cliente=:A";
        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(":A", $rut);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
}
