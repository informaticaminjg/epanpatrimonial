<?php

use yii\helpers\Url;

$this->title = 'Estadísticas Patrimoniales';

$this->registerCssFile(
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'
);

$this->registerJsFile(
    'https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js',
    ['position' => \yii\web\View::POS_HEAD]
);
?>

<style>

    body {
        background: #f4f7fb;
    }

    /* =========================================================
       CONTENEDOR PRINCIPAL
       ========================================================= */

    .estadisticas-page {
        max-width: 900px;
        margin: 0 auto;
        padding-bottom: 90px;
    }

    /* =========================================================
       HEADER
       ========================================================= */

    .stats-header {
        background: linear-gradient(135deg, #0d2b50, #145da0);
        color: white;
        padding: 18px 20px 22px;
        border-radius: 0 0 20px 20px;
        margin-bottom: 18px;
    }

    .stats-header-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .brand-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: rgba(255,255,255,.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .brand-title {
        font-size: 21px;
        font-weight: 700;
        line-height: 1.1;
    }

    .brand-subtitle {
        font-size: 11px;
        opacity: .85;
        margin-top: 3px;
    }

    .menu-btn {
        border: 0;
        background: transparent;
        color: white;
        font-size: 27px;
    }

    /* =========================================================
       TITULO
       ========================================================= */

    .page-title {
        padding: 20px 5px 0;
        margin-bottom: 15px;
    }

    .page-title h1 {
        font-size: 24px;
        color: #12365d;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .page-title p {
        color: #6c7a89;
        font-size: 13px;
        margin: 0;
    }

    /* =========================================================
       FILTRO
       ========================================================= */

    .filter-card {
        background: white;
        border-radius: 14px;
        padding: 12px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,.05);
    }

    .filter-card select {
        border-radius: 10px;
        border: 1px solid #dce5ef;
        font-size: 13px;
        height: 42px;
    }

    /* =========================================================
       CARDS
       ========================================================= */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-bottom: 15px;
    }

    .stat-card {
        border-radius: 14px;
        padding: 14px;
        min-height: 125px;
        position: relative;
        overflow: hidden;
    }

    .stat-card .icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 19px;
        margin-bottom: 8px;
    }

    .stat-title {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .stat-number {
        font-size: 24px;
        font-weight: 700;
        color: #12365d;
    }

    .stat-change {
        font-size: 11px;
        margin-top: 2px;
        font-weight: 600;
    }

    .positive {
        color: #1ca56d;
    }

    .negative {
        color: #e94b4b;
    }

    .blue-card {
        background: #edf6ff;
        border: 1px solid #c8e2ff;
    }

    .blue-card .icon {
        background: #1682ed;
    }

    .green-card {
        background: #ebfaf2;
        border: 1px solid #c7ecd9;
    }

    .green-card .icon {
        background: #20aa6b;
    }

    .purple-card {
        background: #f3edff;
        border: 1px solid #ddd0ff;
    }

    .purple-card .icon {
        background: #7250c9;
    }

    .cyan-card {
        background: #eafaff;
        border: 1px solid #c6edf7;
    }

    .cyan-card .icon {
        background: #0ca8bd;
    }

    .red-card {
        background: #fff0f1;
        border: 1px solid #ffd2d6;
    }

    .red-card .icon {
        background: #ef4148;
    }

    .orange-card {
        background: #fff5e8;
        border: 1px solid #ffdfb2;
    }

    .orange-card .icon {
        background: #ed8b17;
    }

    /* =========================================================
       SECCIONES
       ========================================================= */

    .dashboard-card {
        background: white;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,.05);
        border: 1px solid #e8eef5;
    }

    .dashboard-title {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #12365d;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .dashboard-title i {
        color: #1479df;
        font-size: 18px;
    }

    .chart-container {
        position: relative;
        height: 250px;
    }

    /* =========================================================
       DOS COLUMNAS
       ========================================================= */

    .two-columns {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
    }

    /* =========================================================
       ALERTAS
       ========================================================= */

    .alerts-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }

    .alert-box {
        padding: 12px;
        border-radius: 11px;
        min-height: 82px;
    }

    .alert-number {
        font-size: 22px;
        font-weight: 700;
    }

    .alert-text {
        font-size: 10px;
        color: #596979;
        line-height: 1.25;
    }

    .alert-red {
        background: #fff0f1;
        border: 1px solid #ffd0d4;
        color: #df353d;
    }

    .alert-orange {
        background: #fff7e8;
        border: 1px solid #ffe0ad;
        color: #e08a00;
    }

    .alert-blue {
        background: #edf6ff;
        border: 1px solid #cce4ff;
        color: #1479df;
    }

    .alert-purple {
        background: #f4efff;
        border: 1px solid #ded2ff;
        color: #7250c9;
    }

    /* =========================================================
       TABLA
       ========================================================= */

    .table-responsive {
        overflow-x: auto;
    }

    .movements-table {
        width: 100%;
        min-width: 520px;
        font-size: 11px;
    }

    .movements-table th {
        background: #f4f7fb;
        color: #536578;
        padding: 8px;
        font-weight: 700;
    }

    .movements-table td {
        padding: 8px;
        border-bottom: 1px solid #edf1f5;
        color: #33485c;
    }

    /* =========================================================
       NAV MOBILE
       ========================================================= */

    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 67px;
        background: rgba(255,255,255,.97);
        border-top: 1px solid #dde5ed;
        display: flex;
        justify-content: space-around;
        align-items: center;
        z-index: 1000;
        box-shadow: 0 -3px 12px rgba(0,0,0,.06);
    }

    .bottom-nav a {
        text-decoration: none;
        color: #718096;
        text-align: center;
        font-size: 10px;
    }

    .bottom-nav i {
        display: block;
        font-size: 21px;
        margin-bottom: 2px;
    }

    .bottom-nav a.active {
        color: #1682ed;
        font-weight: 700;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (min-width: 768px) {

        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .stats-header {
            border-radius: 15px;
            margin-top: 15px;
        }

        .bottom-nav {
            left: 50%;
            transform: translateX(-50%);
            width: 500px;
            border-radius: 15px 15px 0 0;
        }
    }

    @media (max-width: 480px) {

        .stats-grid {
            gap: 8px;
        }

        .stat-card {
            padding: 11px;
        }

        .stat-number {
            font-size: 21px;
        }

        .stat-title {
            font-size: 11px;
        }

        .chart-container {
            position: relative;
            height: 260px;
        }

        .two-columns {
            grid-template-columns: 1fr;
        }
    }

</style>


<div class="estadisticas-page">

    <!-- =====================================================
         HEADER
         ====================================================== -->
    

    <!-- =====================================================
         TITULO
         ====================================================== -->

    <div class="page-title">

        <h1>
            Estadísticas Patrimoniales
        </h1>

        <p>
            Resumen general del patrimonio registrado en el sistema.
        </p>

    </div>


    <!-- =====================================================
         FILTRO
         ====================================================== -->

    <div class="filter-card">

        <select class="form-select" id="filtroPeriodo">

            <option value="2026">
                2026
            </option>

            <option value="2025">
                2025
            </option>

            <option value="2024">
                2024
            </option>

        </select>

    </div>


    <!-- =====================================================
         CARDS
         ====================================================== -->

    <div class="stats-grid">

        <div class="stat-card blue-card">

            <div class="icon">
                <i class="bi bi-box"></i>
            </div>

            <div class="stat-title">
                Bienes registrados
            </div>

            <div class="stat-number">
                12.458
            </div>

            <div class="stat-change positive">
                ↑ 5%
            </div>

        </div>


        <div class="stat-card green-card">

            <div class="icon">
                <i class="bi bi-geo-alt-fill"></i>
            </div>

            <div class="stat-title">
                Ubicaciones
            </div>

            <div class="stat-number">
                38
            </div>

            <div class="stat-change">
                sin cambios
            </div>

        </div>


       <div class="stat-card purple-card">

            <div class="icon">
                <i class="bi bi-clipboard-check-fill"></i>
            </div>

            <div class="stat-title">
                Relevamientos
            </div>

            <div class="stat-number">
                1.284
            </div>

            <div class="stat-change positive">
                ↑ 3%
            </div>

        </div>


        <div class="stat-card cyan-card">

            <div class="icon">
                <i class="bi bi-plus-lg"></i>
            </div>

            <div class="stat-title">
                Altas este mes
            </div>

            <div class="stat-number">
                126
            </div>

            <div class="stat-change positive">
                ↑ 12%
            </div>

        </div>


        <div class="stat-card red-card">

            <div class="icon">
                <i class="bi bi-trash3-fill"></i>
            </div>

            <div class="stat-title">
                Bajas este mes
            </div>

            <div class="stat-number">
                18
            </div>

            <div class="stat-change negative">
                ↓ 24%
            </div>

        </div>


        <div class="stat-card orange-card">

            <div class="icon">
                <i class="bi bi-upc-scan"></i>
            </div>

            <div class="stat-title">
                Escaneos realizados
            </div>

            <div class="stat-number">
                3.842
            </div>

            <div class="stat-change positive">
                ↑ 18%
            </div>

        </div>

    </div>


    <!-- =====================================================
         EVOLUCION
         ====================================================== -->

    <div class="dashboard-card">

        <div class="dashboard-title">

            <i class="bi bi-graph-up"></i>

            Evolución del patrimonio

        </div>

        <div class="chart-container">

            <canvas id="evolucionChart"></canvas>

        </div>

    </div>


    <!-- =====================================================
         TIPOS DE BIENES / DEPENDENCIAS
         ====================================================== -->

    <div class="two-columns">

        <div class="dashboard-card">

            <div class="dashboard-title">

                <i class="bi bi-box"></i>

                Tipos de bienes

            </div>

            <div class="chart-container">

                <canvas id="tiposChart"></canvas>

            </div>

        </div>


        <div class="dashboard-card">

            <div class="dashboard-title">

                <i class="bi bi-building"></i>

                Patrimonio por dependencia

            </div>

            <div class="chart-container">

                <canvas id="dependenciasChart"></canvas>

            </div>

        </div>

    </div>


    <!-- =====================================================
         ACTIVIDAD ESCANEO
         ====================================================== -->

    <div class="dashboard-card">

        <div class="dashboard-title">

            <i class="bi bi-upc-scan"></i>

            Actividad de escaneo

        </div>

        <div class="chart-container">

            <canvas id="escaneoChart"></canvas>

        </div>

    </div>


    <!-- =====================================================
         ESTADO VEHICULOS
         ====================================================== -->

    <div class="dashboard-card">

        <div class="dashboard-title">

            <i class="bi bi-car-front-fill"></i>

            Estado de vehículos

        </div>

        <div class="chart-container">

            <canvas id="vehiculosChart"></canvas>

        </div>

    </div>


    <!-- =====================================================
         ALERTAS
         ====================================================== -->

    <div class="dashboard-card">

        <div class="dashboard-title">

            <i class="bi bi-exclamation-triangle-fill text-danger"></i>

            Alertas patrimoniales

        </div>


        <div class="alerts-grid">

            <div class="alert-box alert-red">

                <div class="alert-number">
                    23
                </div>

                <div class="alert-text">
                    Bienes sin ubicación asignada
                </div>

            </div>


            <div class="alert-box alert-orange">

                <div class="alert-number">
                    17
                </div>

                <div class="alert-text">
                    Pendientes de verificación
                </div>

            </div>


            <div class="alert-box alert-blue">

                <div class="alert-number">
                    41
                </div>

                <div class="alert-text">
                    Registros con datos incompletos
                </div>

            </div>


            <div class="alert-box alert-purple">

                <div class="alert-number">
                    8
                </div>

                <div class="alert-text">
                    Vehículos sin matrícula registrada
                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         ULTIMOS MOVIMIENTOS
         ====================================================== -->

    <div class="dashboard-card">

        <div class="dashboard-title">

            <i class="bi bi-clock-history"></i>

            Últimos movimientos

        </div>


        <div class="table-responsive">

            <table class="movements-table">

                <thead>

                    <tr>

                        <th>
                            Fecha
                        </th>

                        <th>
                            Matrícula / Bien
                        </th>

                        <th>
                            Operación
                        </th>

                        <th>
                            Dependencia
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>
                            07/09/2026
                        </td>

                        <td>
                            724-191973
                        </td>

                        <td>
                            Alta
                        </td>

                        <td>
                            Transporte
                        </td>

                    </tr>


                    <tr>

                        <td>
                            07/09/2026
                        </td>

                        <td>
                            851-224561
                        </td>

                        <td>
                            Modificación
                        </td>

                        <td>
                            Patrimonio
                        </td>

                    </tr>


                    <tr>

                        <td>
                            06/09/2026
                        </td>

                        <td>
                            632-119845
                        </td>

                        <td>
                            Baja
                        </td>

                        <td>
                            Depósito
                        </td>

                    </tr>


                    <tr>

                        <td>
                            06/09/2026
                        </td>

                        <td>
                            912-553821
                        </td>

                        <td>
                            Verificación
                        </td>

                        <td>
                            Transporte
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- =========================================================
     MENU INFERIOR
     ========================================================== -->

<div class="bottom-nav">

    <a href="<?= Url::to(['/site/index']) ?>">

        <i class="bi bi-house-fill"></i>

        Inicio

    </a>


    <a href="<?= Url::to(['/site/estadisticas']) ?>"
       class="active">

        <i class="bi bi-bar-chart-fill"></i>

        Estadísticas

    </a>


    <a href="<?= Url::to(['/site/scanner']) ?>">

        <i class="bi bi-upc-scan"></i>

        Escáner

    </a>


    <a href="<?= Url::to(['/site/reportes']) ?>">

        <i class="bi bi-file-earmark-text"></i>

        Reportes

    </a>


    <a href="<?= Url::to(['/site/configuracion']) ?>">

        <i class="bi bi-gear-fill"></i>

        Configuración

    </a>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
     * =========================================================
     * EVOLUCION DEL PATRIMONIO
     * =========================================================
     */

    new Chart(
        document.getElementById('evolucionChart'),
        {
            type: 'line',

            data: {

                labels: [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'
                ],

                datasets: [

                    {
                        label: 'Total',

                        data: [
                            6200,
                            6800,
                            7500,
                            8200,
                            9000,
                            9500,
                            10100,
                            10800,
                            11600,
                            12000,
                            12500,
                            13000
                        ],

                        borderColor: '#1682ed',

                        backgroundColor: 'rgba(22,130,237,.08)',

                        tension: .35,

                        fill: true
                    },

                    {
                        label: 'Altas',

                        data: [
                            1100,
                            1300,
                            1600,
                            1900,
                            2200,
                            2500,
                            2800,
                            3100,
                            3400,
                            3600,
                            3900,
                            4100
                        ],

                        borderColor: '#20aa6b',

                        tension: .35
                    },

                    {
                        label: 'Bajas',

                        data: [
                            300,
                            400,
                            450,
                            500,
                            600,
                            650,
                            700,
                            750,
                            800,
                            850,
                            900,
                            950
                        ],

                        borderColor: '#ef4148',

                        tension: .35
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'bottom'
                    }

                },

                scales: {

                    y: {
                        beginAtZero: true
                    }

                }

            }

        }
    );


    /*
     * =========================================================
     * TIPOS DE BIENES
     * =========================================================
     */

    new Chart(
        document.getElementById('tiposChart'),
        {
            type: 'doughnut',

            data: {

                labels: [
                    'Mobiliario',
                    'Informática',
                    'Vehículos',
                    'Herramientas',
                    'Equipamiento',
                    'Otros'
                ],

                datasets: [

                    {
                        data: [
                            42,
                            27,
                            18,
                            6,
                            4,
                            3
                        ]
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'bottom'
                    }

                }

            }

        }
    );


    /*
     * =========================================================
     * DEPENDENCIAS
     * =========================================================
     */

    new Chart(
        document.getElementById('dependenciasChart'),
        {
            type: 'bar',

            data: {

                labels: [
                    'Administración',
                    'Patrimonio',
                    'Informática',
                    'Transporte',
                    'Depósito',
                    'Otras'
                ],

                datasets: [

                    {
                        label: 'Bienes',

                        data: [
                            3842,
                            2951,
                            2104,
                            1452,
                            1023,
                            486
                        ]
                    }

                ]

            },

            options: {

                indexAxis: 'y',

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: false
                    }

                }

            }

        }
    );


    /*
     * =========================================================
     * ESCANEO
     * =========================================================
     */

    new Chart(
        document.getElementById('escaneoChart'),
        {
            type: 'doughnut',

            data: {

                labels: [
                    'Reconocidos',
                    'No encontrados',
                    'Corrección manual'
                ],

                datasets: [

                    {
                        data: [
                            3517,
                            226,
                            94
                        ]
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'bottom'
                    }

                }

            }

        }
    );


    /*
     * =========================================================
     * VEHICULOS
     * =========================================================
     */

    new Chart(
        document.getElementById('vehiculosChart'),
        {
            type: 'doughnut',

            data: {

                labels: [
                    'Activos',
                    'En mantenimiento',
                    'Fuera de servicio',
                    'Dados de baja'
                ],

                datasets: [

                    {
                        data: [
                            1106,
                            87,
                            52,
                            39
                        ]
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'bottom'
                    }

                }

            }

        }
    );

});

</script>