<?php

namespace models;

require_once("Conexion.php");

class RecetaModel
{

    public function insertarReceta($data)
    {
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
    }
    public function getMateriales()
    {
    }

    public function getArmazones()
    {
    }

    public function getTipos()
    {
    }
}
