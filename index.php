<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col l2 m12 s12"></div>
            <div class="col l8 m12 s12 center">
                <h4>Buscar Receta por rut</h4>
                <form action="controllers/BuscarRecetaRut.php" method="POST">
                    <input type="text" placeholder="Rut Cliente" name="rut">
                    <button class="btn-small">buscar</button>
                </form>
                <p>

                    <?php if (isset($_SESSION['receta_rut'])) { ?>
                        <?php $receta_list = $_SESSION['receta_rut'];  ?>
                        <?php // print_r($receta_list); 
                        ?>
                        <form action="controllers/BuscarRecetaId.php" method="POST">
                            <table>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Armazón</th>
                                    <th>Tipo Cristal</th>
                                    <th>Fecha Retiro</th>
                                    <th></th>

                                </tr>
                                <?php foreach ($receta_list as $receta) { ?>
                                    <tr>
                                        <td><?= $receta['nombre_cliente'] ?></td>
                                        <td><?= $receta['armazon'] ?></td>
                                        <td><?= $receta['tipo_cristal'] ?></td>
                                        <td><?= $receta['fecha_retiro'] ?></td>
                                        <td>
                                            <button name="id" value="<?= $receta['id'] ?>" class="btn-small blue">
                                                detalle
                                            </button>
                                        </td>

                                    </tr>

                                <?php } ?>
                            </table>
                            <?php if (isset($_SESSION['detalle'])) { ?>
                                <h4>Detalle Receta</h4>
                                <div class="row left-align">
                                    <div class="col l4">
                                        <b>Tipo de lente</b>
                                        <br>
                                        <span class="blue-grey-text lighten-3">
                                            <?= $_SESSION['detalle']['tipo_lente'] ?>
                                        </span>
                                    </div>
                                    <div class="col l4">
                                        <b>Base</b> <br>
                                        <span class="blue-grey-text lighten-3">
                                            <?= $_SESSION['detalle']['base'] ?>
                                        </span>
                                    </div>
                                    <div class="col l4">
                                        <b>Tipo Cristal</b><bR>
                                        <span class="blue-grey-text lighten-3">
                                            <?= $_SESSION['detalle']['tipo_cristal'] ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="row left-align">
                                    <div class="col l4">
                                        <b>Armazón</b><br> <?= $_SESSION['detalle']['armazon'] ?>
                                    </div>
                                    <div class="col l4">
                                        <b>Material Cristal</b><br> <?= $_SESSION['detalle']['material_cristal'] ?>
                                    </div>
                                    <div class="col l4">
                                        <b>Vendedor</b><br> <?= $_SESSION['detalle']['nombre_vendedor'] ?>
                                    </div>
                                </div>
                                <br>
                            <?php //print_r($_SESSION['detalle']);
                            } ?>


                        </form>


                    <?php } else {
                        print "NONE";
                    } ?>
                </p>
            </div>

        </div>

    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>