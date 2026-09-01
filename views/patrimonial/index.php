<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Inicio';

function iconFor($bien) {

    $cat = strtolower($bien->categoria ?? '');

    if (strpos($cat, 'mobiliario') !== false) {
        return 'fa-chair';
    }

    if (strpos($cat, 'audiovisual') !== false) {
        return 'fa-video';
    }

    if (
        strpos($cat, 'informático') !== false ||
        strpos($cat, 'informatico') !== false
    ) {
        return 'fa-laptop';
    }

    return 'fa-box';
}
?>

<div class="page">
    <div class="welcome">
        <div>
            <div class="eyebrow">CONSULTA PATRIMONIAL</div>
            <h1>¿Qué deseas hacer?</h1>
            <p>Escaneá el bien para consultar toda su información.</p>
        </div>
    </div>

    <a class="scan-card" href="<?= Url::to(['patrimonial/escanear-matricula']) ?>">
        <div class="scan-icon blue"><i class="fa-solid fa-camera"></i></div>
        <div class="scan-text">
            <strong>Escanear Matrícula</strong>
            <span>Reconoce el número escrito en el bien</span>
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </a>

    <a class="scan-card" href="<?= Url::to(['patrimonial/escanear-barcode']) ?>">
        <div class="scan-icon green"><i class="fa-solid fa-barcode"></i></div>
        <div class="scan-text">
            <strong>Escanear Código de Barras</strong>
            <span>Lee el código para obtener el número de serie</span> 
        </div>
        
    </a>
  
   <a class="scan-card" href="<?= Url::to(['relevamientopat/create']) ?>">
        <div class="scan-icon orange">
            <i class="fa-solid fa-building"></i>
        </div>

        <div class="scan-text">
            <strong>Relevar Lugar</strong>
            <span>Registrar y consultar los bienes de un lugar</span>
        </div>

        <i class="fa-solid fa-chevron-right arrow"></i>
    </a>

    <a class="scan-card" href="<?= Url::to(['patrimonial/registro-por-persona']) ?>">
        <div class="scan-icon purple">
            <i class="fa-solid fa-id-card"></i>
        </div>
        <div class="scan-text">
            <strong>Registro Patrimonial por Persona</strong>
            <span>Consultar los bienes asignados a una persona</span>
        </div>
        <i class="fa-solid fa-chevron-right arrow"></i>
    </a>
    <div class="section-title">
        <h2>Mis Últimos 10 escaneos</h2>
        <a href="<?= Url::to(['patrimonial/historial']) ?>">Ver todos</a>
    </div>
    <div class="list-card">

        <?php
        // ==========================================
        // ÚLTIMOS ESCANEOS - DEMO
        // ==========================================

        $ultimosDemo = [

            (object)[
                'matricula'   => 'MAT-2024-000123',
                'descripcion' => 'Notebook Dell Latitude 5420',
                'categoria'   => 'Informático',
                'fecha_hora'  => date('Y-m-d 09:30:00'),
            ],

            (object)[
                'matricula'   => 'MAT-2024-000122',
                'descripcion' => 'Silla Ejecutiva Ergonomica',
                'categoria'   => 'Mobiliario',
                'fecha_hora'  => date('Y-m-d 09:15:00'),
            ],

            (object)[
                'matricula'   => 'MAT-2024-000121',
                'descripcion' => 'Proyector Epson X49',
                'categoria'   => 'Audiovisual',
                'fecha_hora'  => date('Y-m-d 16:45:00', strtotime('-1 day')),
            ],
        ];
        ?>

        <?php foreach ($ultimosDemo as $bien): ?>

            <a class="history-row"
            href="<?= Url::to([
                'patrimonial/detalle',
                //'id' => $bien->matricula
                'id' => 999999
            ]) ?>">

                <!-- ÍCONO -->
                <div class="history-icon">
                    <i class="fa-solid <?= iconFor($bien) ?>"></i>
                </div>

                <!-- INFORMACIÓN -->
                <div class="history-info">

                    <strong>
                        <?= Html::encode($bien->matricula) ?>
                    </strong>

                    <span>
                        <?= Html::encode($bien->descripcion) ?>
                    </span>
                    <small class="history-time">

                        <?php
                        $fecha = strtotime($bien->fecha_hora);

                        if (date('Y-m-d', $fecha) === date('Y-m-d')) {
                            echo 'Hoy, ' . date('H:i', $fecha);
                        } else {
                            echo 'Ayer, ' . date('H:i', $fecha);
                        }
                        ?>

                    </small>
                </div>

            

                <!-- ABRIR -->
                <div class="history-open">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </div>

            </a>

        <?php endforeach; ?>

    </div>
    <!-- Ultimos Relevamientos  -->

    <div class="section-title">
        <h2>Mis Últimos 10 Relevamientos</h2>
        <a href="<?= Url::to(['patrimonial/relevamientos']) ?>">Ver todos</a>
    </div>

    <div class="list-card">

        <?php
        // ==========================================
        // ÚLTIMOS RELEVAMIENTOS - DEMO
        // ==========================================

        $ultimosRelevamientosDemo = [

            (object)[
                'id'          => 1,
                'lugar'       => 'Oficina de Patrimonio',
                'descripcion' => 'Relevamiento de bienes informáticos',
                'fecha_hora'  => date('Y-m-d 10:15:00'),
            ],

            (object)[
                'id'          => 2,
                'lugar'       => 'Depósito Central',
                'descripcion' => 'Control y relevamiento de mobiliario',
                'fecha_hora'  => date('Y-m-d 09:40:00'),
            ],

            (object)[
                'id'          => 3,
                'lugar'       => 'Edificio Administrativo',
                'descripcion' => 'Relevamiento general de bienes',
                'fecha_hora'  => date('Y-m-d 15:30:00', strtotime('-1 day')),
            ],

        ];
        ?>

        <?php foreach ($ultimosRelevamientosDemo as $relevamiento): ?>

            <a class="history-row"
            href="<?= Url::to([
                'relevamientopat/detalle-relevamiento',
                'id' => $relevamiento->id
            ]) ?>">

                <!-- ÍCONO -->
                <div class="history-icon">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>

                <!-- INFORMACIÓN -->
                <div class="history-info">

                    <strong>
                        <?= Html::encode($relevamiento->lugar) ?>
                    </strong>

                    <span>
                        <?= Html::encode($relevamiento->descripcion) ?>
                    </span>

                    <small class="history-time">

                        <?php
                        $fecha = strtotime($relevamiento->fecha_hora);

                        if (date('Y-m-d', $fecha) === date('Y-m-d')) {
                            echo 'Hoy, ' . date('H:i', $fecha);
                        } elseif (date('Y-m-d', $fecha) === date('Y-m-d', strtotime('-1 day'))) {
                            echo 'Ayer, ' . date('H:i', $fecha);
                        } else {
                            echo date('d/m/Y H:i', $fecha);
                        }
                        ?>

                    </small>

                </div>

                <!-- ABRIR -->
                <div class="history-open">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </div>

            </a>

        <?php endforeach; ?>

    </div>


    <div class="info-banner">
        <i class="fa-solid fa-circle-info"></i>
        <div>
            <strong>Datos de ejemplo</strong>
            <span>Esta versión consulta una base simulada de SICOPRO.</span>
        </div>
    </div>
</div>
