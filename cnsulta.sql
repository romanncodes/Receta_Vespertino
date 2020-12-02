select id_receta "id", tipo_lente, esfera_oi, esfera_od,
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
where receta.rut_cliente = :A 