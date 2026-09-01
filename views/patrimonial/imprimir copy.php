<?php
use yii\helpers\Html;

$this->title = 'Vista de Impresión';
?>
<div class="print-page">
    <div class="print-actions no-print">
        <button class="primary-button" onclick="window.print()">
            <i class="fa-solid fa-print"></i> Imprimir
        </button>
        <button class="secondary-button" onclick="window.history.back()">Volver</button>
    </div>

    <article class="print-sheet">
        <header class="print-header">
            <div>
                <strong>ePan Patrimonial</strong>
                <span>Reporte de Bien Patrimonial</span>
            </div>
            <div><?= date('d/m/Y H:i') ?></div>
        </header>

        <section>
            <h2>Información del Bien</h2>
            <div class="print-grid">
                <div><b>Matrícula</b><span><?= Html::encode($bien->matricula) ?></span></div>
                <div><b>Descripción</b><span><?= Html::encode($bien->descripcion) ?></span></div>
                <div><b>Número de serie</b><span><?= Html::encode($bien->numero_serie) ?></span></div>
                <div><b>Código de barras</b><span><?= Html::encode($bien->codigo_barras) ?></span></div>
                <div><b>Marca</b><span><?= Html::encode($bien->marca) ?></span></div>
                <div><b>Modelo</b><span><?= Html::encode($bien->modelo) ?></span></div>
                <div><b>Categoría</b><span><?= Html::encode($bien->categoria) ?></span></div>
                <div><b>Estado</b><span><?= Html::encode($bien->estado) ?></span></div>
                <div><b>Fecha de alta</b><span><?= Yii::$app->formatter->asDate($bien->fecha_alta) ?></span></div>
                <div><b>Valor de adquisición</b><span>$ <?= Yii::$app->formatter->asDecimal($bien->valor_adquisicion, 2) ?></span></div>
                <div><b>Dependencia actual</b><span><?= Html::encode($bien->dependencia_actual) ?></span></div>
                <div><b>Ubicación</b><span><?= Html::encode($bien->ubicacion_actual) ?></span></div>
            </div>
        </section>

        <section>
            <h2>Personas que tuvieron o tienen el bien a cargo</h2>
            <table>
                <thead>
                    <tr><th>Nombre</th><th>Dependencia</th><th>Desde</th><th>Hasta</th></tr>
                </thead>
                <tbody>
                <?php foreach ($bien->personas as $persona): ?>
                    <?php
                    $rel = Yii::$app->db->createCommand("
                        SELECT desde, hasta
                        FROM epan_bien_persona
                        WHERE bien_id = :bien AND persona_id = :persona
                        LIMIT 1
                    ", [':bien'=>$bien->id, ':persona'=>$persona->id])->queryOne();
                    ?>
                    <tr>
                        <td><?= Html::encode($persona->nombre) ?></td>
                        <td><?= Html::encode($persona->dependencia) ?></td>
                        <td><?= Yii::$app->formatter->asDate($rel['desde']) ?></td>
                        <td><?= $rel['hasta'] ? Yii::$app->formatter->asDate($rel['hasta']) : 'Actual' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <footer>
            Documento generado por ePan Patrimonial. Datos de ejemplo.
        </footer>
    </article>
</div>
