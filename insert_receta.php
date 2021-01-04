<?php

use models\RecetaModel;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("models/RecetaModel.php");
session_start();

$model = new RecetaModel();

$tipos = $model->getTipos();
$armazones = $model->getArmazones();
$materiales = $model->getMateriales();
$base = ['No Aplica', 'Superior', 'Inferior', 'Interna', 'Externa'];
$prisma = ['No Aplica', '1', '2', '3', '4', '5'];
//print_r($model->getTipos());




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body class="green">

    <!-- menu -->
    <div class="container">
        <div class="card-panel">
            <div class="row">
                <div class="col l12 m12 s12">
                    <form action="controllers/NuevaReceta.php" method="POST">
                        <button class="btn-small blue right">Nueva Receta</button>
                    </form>
                    <!-- MENSAJES DESDE EL CONTROLADOR -->
                    <?php if (isset($_SESSION['success'])) {
                        echo ' <p class="green-text">' . $_SESSION['success'] . '</p>';
                        unset($_SESSION['success']);
                    }
                    ?>

                    <?php if (isset($_SESSION['error_tipo_lente'])) {
                        echo '<p class="red-text">' . $_SESSION['error_tipo_lente'] . '</p>';
                        unset($_SESSION['error_tipo_lente']);
                    }
                    ?>

                    <?php if (isset($_SESSION['error_rut_cliente'])) {
                        echo '<p class="red-text">' . $_SESSION['error_rut_cliente'] . '</p>';
                        unset($_SESSION['error_rut_cliente']);
                    }
                    ?>

                    <?php if (isset($_SESSION['error_eje_oi'])) {
                        echo '<p class="red-text">' . $_SESSION['error_eje_oi'] . '</p>';
                        unset($_SESSION['error_eje_oi']);
                    }
                    ?>

                    <?php if (isset($_SESSION['error_eje_od'])) {
                        echo '<p class="red-text">' . $_SESSION['error_eje_od'] . '</p>';
                        unset($_SESSION['error_eje_od']);
                    }
                    ?>

                    <?php if (isset($_SESSION['error_observacion'])) {
                        echo '<p class="red-text">' . $_SESSION['error_observacion'] . '</p>';
                        unset($_SESSION['error_observacion']);
                    }
                    ?>

                    <!-- END MENSAJES DESDE EL CONTROLADOR-->




                </div>
            </div>
        </div>

        <!-- modulo buscar cliente-->
        <div class="card-panel">
            <div class="row">
                <div class="col l4 m4 s12">
                    <form action="controllers/BuscarClienteRut.php" method="POST">

                        <input type="text" name="rut" placeholder="Rut Cliente" value="<?= isset($_SESSION['cliente']) ? $_SESSION['cliente']['rut_cliente'] : ''  ?>" />

                        <button class="btn-small">Buscar</button>
                    </form>
                </div>
                <div class="col l8 m8 s12">
                    <!-- session cuando no es encontrado el cliente-->
                    <?php if (isset($_SESSION['error'])) { ?>
                        <p class="red-text">
                            <?= $_SESSION['error'] ?>
                        </p>
                    <?php
                        unset($_SESSION['error']);
                    }
                    ?>

                    <!-- session cuando el cliente existe-->
                    <?php if (isset($_SESSION['cliente'])) { ?>
                        <div class="collection">
                            <a href="#!" class="collection-item">
                                Nombre:
                                <?= $_SESSION['cliente']['nombre_cliente'] ?>
                            </a>
                            <a href="#!" class="collection-item">
                                Teléfono:
                                <?= $_SESSION['cliente']['telefono_cliente'] ?>
                            </a>

                        </div>

                    <?php

                    } ?>
                </div>
            </div>
        </div>
        <!-- end modulo buscar cliente-->


        <form action="controllers/InsertarReceta.php" method="POST">
            <input type="hidden" name="rut_cliente" value="<?php if (isset($_SESSION['cliente'])) {
                                                                echo $_SESSION['cliente']['rut_cliente'];
                                                                //unset($_SESSION['cliente']);
                                                            } else {
                                                                echo "";
                                                            }  ?>" />
            <!-- modulo ingreso de datos parte 1-->
            <div class="card-panel">

                <div class="row">
                    <div class="col l3 m3 s12">
                        <span class="green-text">Tipo Lente</span>
                        <p>
                            <label>
                                <input type="checkbox" name="tipo_lente[]" value="Cerca" <?php if (isset($_SESSION['data'])) {
                                                                                                if (strpos($_SESSION['data']['tipo_lente'], 'Cerca') !== false) {
                                                                                                    echo ' checked ';
                                                                                                }
                                                                                            }
                                                                                            ?> />
                                <span>Cerca</span>
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input type="checkbox" name="tipo_lente[]" value="Lejos" <?php if (isset($_SESSION['data'])) {
                                                                                                if (strpos($_SESSION['data']['tipo_lente'], 'Lejos') !== false) {
                                                                                                    echo ' checked ';
                                                                                                }
                                                                                            }
                                                                                            ?> />
                                <span>Lejos</span>
                            </label>
                        </p>
                    </div>
                    <div class="col l3 m3 s12"></div>
                    <div class="col l3 m3 s12">
                        <span class="green-text">Esfera Izquierda</span>
                        <input pattern="[+-]+[0-9].[0-9]{2,}" title="Ejemplo +0.25, -0.22" type="text" name="esfera_oi" placeholder="+0.25" required value="<?= isset($_SESSION['data']) ? $_SESSION['data']['esfera_oi'] : ''  ?>">
                    </div>
                    <div class="col l3 m3 s12">
                        <span class="green-text">Esfera Derecha</span>
                        <input pattern="[+-]+[0-9].[0-9]{2,}" title="Ejemplo +0.25, -0.22" type="text" name="esfera_od" placeholder="+0.25" required value="<?= isset($_SESSION['data']) ? $_SESSION['data']['esfera_od'] : ''  ?>">
                    </div>
                </div>
                <div class=" row">
                    <div class="col l3 m3 s12">
                        <span class="green-text">Tipo Cristal</span>
                        <select name="tipo_cristal">
                            <?php foreach ($tipos as $tipo) { ?>
                                <option <?php if (isset($_SESSION['data'])) {
                                            if ($tipo['id_tipo_cristal'] == $_SESSION['data']['tipo_cristal']) {
                                                echo " selected ";
                                            }
                                        }   ?> value="<?= $tipo['id_tipo_cristal'] ?>">
                                    <?= $tipo['tipo_cristal'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <span class="green-text">Base</span>
                        <select name="base">
                            <?php foreach ($base as $b) { ?>
                                <option <?php if (isset($_SESSION['data'])) {
                                            if ($b == $_SESSION['data']['base']) {
                                                echo ' selected ';
                                            }
                                        }  ?> value="<?= $b ?>"><?= $b ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col l3 m3 s12">
                        <span class="green-text">Material de Cristal</span>
                        <select name="material_cristal">
                            <?php foreach ($materiales as $material) { ?>
                                <option <?php if (isset($_SESSION['data'])) {
                                            if ($material['id_material_cristal'] == $_SESSION['data']['material_cristal']) {
                                                echo ' selected ';
                                            }
                                        }  ?> value="<?= $material['id_material_cristal'] ?>"><?= $material['material_cristal'] ?></option>
                            <?php } ?>
                        </select>
                        <span class="green-text">Armazón</span>
                        <select name="armazon">
                            <?php foreach ($armazones as $armazon) { ?>
                                <option <?php if (isset($_SESSION['data'])) {
                                            if ($armazon['id_armazon'] == $_SESSION['data']['armazon']) {
                                                echo ' selected ';
                                            }
                                        }  ?> value="<?= $armazon['id_armazon'] ?>"><?= $armazon['nombre_armazon'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col l3 m3 s12">
                        <span class="green-text">Cilindro Izquierdo</span>
                        <input pattern="[+-]+[0-9].[0-9]{2,}" title="Ejemplo +0.25, -0.22" type="text" name="cilindro_oi" placeholder="+0.25" required value="<?= isset($_SESSION['data']) ? $_SESSION['data']['cilindro_oi'] : ''  ?>">
                        <span class=" green-text">Eje izquierdo</span>
                        <input type="text" name="eje_oi" placeholder="0 - 180" required value="<?= isset($_SESSION['data']) ? $_SESSION['data']['eje_oi'] : ''  ?>">
                    </div>
                    <div class=" col l3 m3 s12">
                        <span class="green-text">Cilindro Derecho</span>
                        <input pattern="[+-]+[0-9].[0-9]{2,}" title="Ejemplo +0.25, -0.22" type="text" name="cilindro_od" placeholder="+0.25" required value="<?= isset($_SESSION['data']) ? $_SESSION['data']['cilindro_od'] : ''  ?>">
                        <span class=" green-text">Eje Derecho</span>
                        <input type="text" name="eje_od" placeholder="0 - 180" required value="<?= isset($_SESSION['data']) ? $_SESSION['data']['eje_od'] : ''  ?>">
                    </div>
                </div>

            </div>
            <!-- end modulo ingreso de datos parte 1-->

            <!-- modulo ingreso de datos parte 2-->
            <div class=" card-panel">
                <div class="row">
                    <div class="col l3 m3 s12">
                        <span class="green-text">Prisma</span>
                        <select name="prisma">
                            <?php foreach ($prisma as $p) { ?>
                                <?php

                                if ($p == 'No Aplica') {
                                    $elem = 0;
                                } else {
                                    $elem = $p;
                                }
                                ?>
                                <option <?php
                                        if (isset($_SESSION['data'])) {
                                            if ($elem == $_SESSION['data']['prisma']) {
                                                echo ' selected ';
                                            }
                                        }
                                        ?> value="<?= $elem ?>"><?= $p ?></option>
                            <?php } ?>
                        </select>
                        <span class="green-text">Rut Médico</span>
                        <input type="text" name="rut_medico" placeholder="11.111.111-1" required value="<?= isset($_SESSION['data']) ? $_SESSION['data']['rut_medico'] : ''  ?>">

                    </div>
                    <div class=" col l3 m3 s12">
                        <span class="green-text">Distancia Pupilar</span>
                        <select name="distancia_pupilar">
                            <?php for ($i = 40; $i <= 75; $i++) { ?>
                                <option <?php if (isset($_SESSION['data'])) {
                                            if ($i == $_SESSION['data']['distancia_pupilar']) {
                                                echo ' selected ';
                                            }
                                        } ?> value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                        <span class="green-text">Nombre Médico</span>
                        <input type="text" name="nombre_medico" placeholder="Nombre Apellido" required value="<?= isset($_SESSION['data']) ? $_SESSION['data']['nombre_medico'] : ''  ?>">
                    </div>
                    <div class=" col l3 m3 s12">
                        <span class="green-text">Fecha Entrega</span>
                        <input type="text" name="fecha_entrega" class="datepicker" placeholder="yyyy-mm-dd" required value="<?= isset($_SESSION['data']) ? $_SESSION['data']['fecha_entrega'] : ''  ?>">
                    </div>
                    <div class=" col l3 m3 s12">
                        <span class="green-text">Precio Lente</span>
                        <input type="number" name="precio" placeholder="20000" required value="<?= isset($_SESSION['data']) ? $_SESSION['data']['valor_lente'] : ''  ?>">
                    </div>
                </div>
                <div class=" row">
                    <div class="col l12 m12 s12">
                        <span class="green-text">Observación</span>
                        <textarea id="textarea1" data-length="300" class="materialize-textarea" name="observacion" required>
                                <?= isset($_SESSION['data']) ? $_SESSION['data']['observacion'] : ''  ?>
                        </textarea>
                    </div>
                </div>

                <button class="btn-small right">Guardar</button>
                <br>
            </div>
            <!-- end modulo ingreso de datos parte 2-->
        </form>





    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems, {
                format: 'yyyy-mm-dd',
                autoClose: true
            });
            var textNeedCount = document.querySelectorAll('#textarea1');
            M.CharacterCounter.init(textNeedCount);
        });
    </script>
</body>

</html>