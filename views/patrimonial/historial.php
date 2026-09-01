<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Historial de Escaneos';

/*
 * ============================================================
 * DATOS DEMO
 * ============================================================
 */

$historialDemo = [

    [
        'grupo'       => 'Hoy',
        'codigo'      => 'MAT-2024-000123',
        'descripcion' => 'Notebook Dell Latitude 5420',
        'hora'        => '09:30',
        'icono'       => 'fa-laptop',
    ],

    [
        'grupo'       => 'Hoy',
        'codigo'      => 'MAT-2024-000122',
        'descripcion' => 'Silla Ejecutiva Ergonómica',
        'hora'        => '09:15',
        'icono'       => 'fa-chair-office',
    ],

    [
        'grupo'       => 'Ayer',
        'codigo'      => 'MAT-2024-000121',
        'descripcion' => 'Proyector Epson X49',
        'hora'        => '16:45',
        'icono'       => 'fa-projector',
    ],

    [
        'grupo'       => 'Ayer',
        'codigo'      => 'MAT-2024-000120',
        'descripcion' => 'Impresora HP LaserJet',
        'hora'        => '14:20',
        'icono'       => 'fa-print',
    ],

    [
        'grupo'       => '23/05/2024',
        'codigo'      => 'MAT-2024-000119',
        'descripcion' => 'Monitor Samsung 24',
        'hora'        => '11:30',
        'icono'       => 'fa-desktop',
    ],

];

?>

<div class="history-page">

    <!-- ===================================================== -->
    <!-- HEADER -->
    <!-- ===================================================== -->

    <div class="history-header">

      

        <div class="history-header-title">
            Historial de Escaneos
        </div>

    </div>


    <!-- ===================================================== -->
    <!-- CONTENIDO -->
    <!-- ===================================================== -->

    <div class="history-content">

        <!-- ================================================= -->
        <!-- BUSCADOR -->
        <!-- ================================================= -->

        <div class="history-search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                id="historySearch"
                type="text"
                placeholder="Buscar por matrícula o descripción"
                autocomplete="off"
            >

        </div>


        <!-- ================================================= -->
        <!-- FILTROS -->
        <!-- ================================================= -->

        <div class="history-filters">

            <select id="historyFilter">

                <option value="todos">
                    Todos
                </option>

                <option value="hoy">
                    Hoy
                </option>

                <option value="ayer">
                    Ayer
                </option>

                <option value="7dias">
                    Últimos 7 días
                </option>

            </select>


            <button
                type="button"
                class="history-calendar"
                id="historyCalendar"
            >
                <i class="fa-regular fa-calendar"></i>
            </button>

        </div>


        <!-- ================================================= -->
        <!-- LISTADO -->
        <!-- ================================================= -->

        <div id="historyList">

            <?php

            $grupo = '';

            foreach ($historialDemo as $item):

                $grupoActual = $item['grupo'];

                /*
                 * Mostrar encabezado solamente cuando cambia
                 * el grupo de fecha.
                 */
                if ($grupoActual !== $grupo):

                    $grupo = $grupoActual;

            ?>

                <div
                    class="history-date"
                    data-group="<?= Html::encode($grupoActual) ?>"
                >
                    <?= Html::encode($grupoActual) ?>
                </div>

            <?php endif; ?>


            <!-- ================================================= -->
            <!-- TARJETA -->
            <!-- ================================================= -->

            <a
                href="#"
                class="history-card searchable"
                data-date="<?= Html::encode($grupoActual) ?>"
            >

                <!-- ICONO DEL BIEN -->

                <div class="history-icon">

                    <i class="fa-solid <?= Html::encode($item['icono']) ?>"></i>

                </div>


                <!-- INFORMACIÓN -->

                <div class="history-info">

                    <strong>
                        <?= Html::encode($item['codigo']) ?>
                    </strong>

                    <span>
                        <?= Html::encode($item['descripcion']) ?>
                    </span>

                </div>


                <!-- HORA -->

                <div class="history-time">

                    <?= Html::encode($item['hora']) ?>

                </div>

            </a>


            <?php endforeach; ?>

        </div>

    </div>


    <!-- ===================================================== -->
    <!-- BOTTOM NAVIGATION -->
    <!-- ===================================================== -->

    <div class="history-bottom-nav">

        <a href="<?= Url::to(['patrimonial/index']) ?>">

            <i class="fa-solid fa-house"></i>

            <span>
                Inicio
            </span>

        </a>


        <a
            href="<?= Url::to(['patrimonial/historial']) ?>"
            class="active"
        >

            <i class="fa-solid fa-clock-rotate-left"></i>

            <span>
                Historial
            </span>

        </a>


        <a href="<?= Url::to(['epan/perfil']) ?>">

            <i class="fa-regular fa-user"></i>

            <span>
                Cuenta
            </span>

        </a>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
     * ========================================================
     * BUSCADOR
     * ========================================================
     */

    const search = document.getElementById('historySearch');

    search.addEventListener('input', function () {

        const q = this.value
            .toLowerCase()
            .trim();

        document.querySelectorAll('.searchable').forEach(function (row) {

            const texto = row.innerText.toLowerCase();

            row.style.display = texto.includes(q)
                ? 'flex'
                : 'none';

        });

        actualizarFechas();

    });


    /*
     * ========================================================
     * FILTRO
     * ========================================================
     */

    const filter = document.getElementById('historyFilter');

    filter.addEventListener('change', function () {

        const valor = this.value;

        document.querySelectorAll('.searchable').forEach(function (row) {

            const fecha = row.dataset.date;

            let mostrar = true;

            if (valor === 'hoy') {

                mostrar = fecha === 'Hoy';

            }

            else if (valor === 'ayer') {

                mostrar = fecha === 'Ayer';

            }

            else if (valor === '7dias') {

                mostrar = true;

            }

            row.style.display = mostrar
                ? 'flex'
                : 'none';

        });

        actualizarFechas();

    });


    /*
     * ========================================================
     * OCULTAR FECHAS SIN REGISTROS VISIBLES
     * ========================================================
     */

    function actualizarFechas() {

        document.querySelectorAll('.history-date').forEach(function (fecha) {

            const grupo = fecha.dataset.group;

            const registros = document.querySelectorAll(
                '.history-card[data-date="' + grupo + '"]'
            );

            let visible = false;

            registros.forEach(function (registro) {

                if (registro.style.display !== 'none') {

                    visible = true;

                }

            });

            fecha.style.display = visible
                ? 'block'
                : 'none';

        });

    }


    /*
     * ========================================================
     * CALENDARIO
     * ========================================================
     */

    document.getElementById('historyCalendar')
        .addEventListener('click', function () {

            alert('Demo: aquí se puede abrir un selector de fecha.');

        });

});

</script>