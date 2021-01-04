<?php

namespace models;

require_once("Conexion.php");

class RecetaModel
{

    public function insertarReceta($data)
    {


        $sql = "INSERT INTO receta VALUES(NULL,:A1,:A2,:A3,:A4,:A5,:A6,:A7,
                :A8,:A9,:A10,:A11,:A12,:A13,:A14,:A15,:A16,:A17,:A18,
                :A19,:A20,:A21,:A22,:A23)";

        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(":A1", $data['tipo_lente']);
        $stm->bindParam(":A2", $data['esfera_oi']);
        $stm->bindParam(":A3", $data['esfera_od']);
        $stm->bindParam(":A4", $data['cilindro_oi']);
        $stm->bindParam(":A5", $data['cilindro_od']);
        $stm->bindParam(":A6", $data['eje_oi']);
        $stm->bindParam(":A7", $data['eje_od']);
        $stm->bindParam(":A8", $data['prisma']);
        $stm->bindParam(":A9", $data['base']);
        $stm->bindParam(":A10", $data['armazon']);
        $stm->bindParam(":A11", $data['material_cristal']);
        $stm->bindParam(":A12", $data['tipo_cristal']);
        $stm->bindParam(":A13", $data['distancia_pupilar']);
        $stm->bindParam(":A14", $data['valor_lente']);
        $stm->bindParam(":A15", $data['fecha_entrega']);
        $stm->bindParam(":A16", $data['fecha_retiro']);
        $stm->bindParam(":A17", $data['observacion']);
        $stm->bindParam(":A18", $data['rut_cliente']);
        $stm->bindParam(":A19", $data['fecha_visita_medico']);
        $stm->bindParam(":A20", $data['rut_medico']);
        $stm->bindParam(":A21", $data['nombre_medico']);
        $stm->bindParam(":A22", $data['rut_usuario']);
        $stm->bindParam(":A23", $data['estado']);



        $count = $stm->execute();
        print($stm->errorCode());
        print_r($stm->errorInfo());
        return $count;
    }

    public function buscarRecetaXRut($rut)
    {
        $sql = ' select id_receta "id", tipo_lente, esfera_oi, esfera_od, ';
        $sql .= ' cilindro_oi, cilindro_od, eje_oi, eje_od, prisma, base, ';
        $sql .= ' ar.nombre_armazon "armazon", mt.material_cristal, ';
        $sql .= ' tc.tipo_cristal, distancia_pupilar, valor_lente "precio", ';
        $sql .= ' fecha_entrega, fecha_retiro, observacion, cl.rut_cliente, ';
        $sql .= ' cl.nombre_cliente, cl.telefono_cliente, us.nombre "nombre_vendedor", ';
        $sql .= ' receta.estado ';
        $sql .= ' from receta ';
        $sql .= ' inner join material_cristal mt on mt.id_material_cristal=receta.material_cristal ';
        $sql .= ' inner join armazon ar on ar.id_armazon = receta.armazon ';
        $sql .= ' inner join tipo_cristal tc on tc.id_tipo_cristal = receta.tipo_cristal ';
        $sql .= ' inner join cliente cl on cl.rut_cliente = receta.rut_cliente ';
        $sql .= ' inner join usuario us on us.rut = receta.rut_usuario ';
        $sql .= ' where receta.rut_cliente = :A ';

        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(":A", $rut);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function buscarRecetaXFecha($fecha)
    {
        $sql = 'select id_receta "id", tipo_lente, esfera_oi, esfera_od,
            cilindro_oi, cilindro_od, eje_oi, eje_od, prisma, base,
            ar.nombre_armazon "armazon", mt.material_cristal,
            tc.tipo_cristal, distancia_pupilar, valor_lente "precio",
            fecha_entrega, fecha_retiro, observacion, cl.rut_cliente,
            cl.nombre_cliente, cl.telefono_cliente, us.nombre "nombre_vendedor",
            receta.estado
            from receta
            inner join material_cristal mt 
                on mt.id_material_cristal=receta.material_cristal
            inner join armazon ar 
                on ar.id_armazon = receta.armazon
            inner join tipo_cristal tc
                on tc.id_tipo_cristal = receta.tipo_cristal
            inner join cliente cl 
                on cl.rut_cliente = receta.rut_cliente
            inner join usuario us
                on us.rut = receta.rut_usuario
            where receta.fecha_entrega = :A ';
        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(":A", $fecha);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function buscarRecetaXID($id)
    {
        $sql = ' select id_receta "id", tipo_lente, esfera_oi, esfera_od, ';
        $sql .= ' cilindro_oi, cilindro_od, eje_oi, eje_od, prisma, base, ';
        $sql .= ' ar.nombre_armazon "armazon", mt.material_cristal, ';
        $sql .= ' tc.tipo_cristal, distancia_pupilar, valor_lente "precio", ';
        $sql .= ' fecha_entrega, fecha_retiro, observacion, cl.rut_cliente, ';
        $sql .= ' cl.nombre_cliente, cl.telefono_cliente, us.nombre "nombre_vendedor", ';
        $sql .= ' receta.estado ';
        $sql .= ' from receta ';
        $sql .= ' inner join material_cristal mt on mt.id_material_cristal=receta.material_cristal ';
        $sql .= ' inner join armazon ar on ar.id_armazon = receta.armazon ';
        $sql .= ' inner join tipo_cristal tc on tc.id_tipo_cristal = receta.tipo_cristal ';
        $sql .= ' inner join cliente cl on cl.rut_cliente = receta.rut_cliente ';
        $sql .= ' inner join usuario us on us.rut = receta.rut_usuario ';
        $sql .= ' where receta.id_receta = :A ';

        $stm = Conexion::conector()->prepare($sql);
        $stm->bindParam(":A", $id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }



    public function getMateriales()
    {
        $stm = Conexion::conector()->prepare("select * from material_cristal");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getArmazones()
    {
        $stm = Conexion::conector()->prepare("select * from armazon");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTipos()
    {
        $stm = Conexion::conector()->prepare("select * from tipo_cristal");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
}
