<?php

namespace app\services;

use app\models\Bien;

class SicoproService
{
    /**
     * =========================================================
     * SICOPRO SIMULADO
     * =========================================================
     *
     * Mientras desarrollamos, estos datos simulan la respuesta
     * que posteriormente vendrá desde SICOPRO.
     */

    private function bienSimulado()
    {
        $bien = new \stdClass();

        $bien->id = 999999;
        $bien->matricula = '123456789';
        $bien->descripcion = 'Notebook Lenovo ThinkPad E14';
        $bien->estado = 'ACTIVO';

        $bien->numero_serie = 'PF4X9K2L';
        $bien->codigo_barras = 'CB123456789';
        $bien->simulado = true;
        $bien->marca = 'LENOVO';
        $bien->modelo = 'THINKPAD E14';
        $bien->categoria = 'EQUIPAMIENTO INFORMÁTICO';

        $bien->fecha_alta = '2023-05-15';
        $bien->valor_adquisicion = 850000.00;

        $bien->dependencia_actual = 'Dirección de Informática';
        $bien->ubicacion_actual = 'Oficina 204';

        $bien->observaciones =
            'Bien incorporado al patrimonio municipal. ' .
            'Equipo asignado para tareas administrativas.';

        // Personas a cargo simuladas
        $persona1 = new \stdClass();

        $persona1->id = 999991;
        $persona1->nombre = 'Juan Pérez';
        $persona1->dependencia = 'Dirección de Informática';

        $persona2 = new \stdClass();

        $persona2->id = 999992;
        $persona2->nombre = 'María González';
        $persona2->dependencia = 'Dirección de Informática';

        $bien->personas = [
            $persona1,
            $persona2
        ];

        return $bien;
    }


    /**
     * =========================================================
     * BUSCAR POR MATRÍCULA
     * =========================================================
     */
    public function buscarPorMatricula($matricula)
    {
        $matricula = strtoupper(trim($matricula));

        // -----------------------------------------
        // SIMULACIÓN
        // -----------------------------------------
        if ($matricula === '123456789') {
            return $this->bienSimulado();
        }

        // -----------------------------------------
        // BÚSQUEDA REAL LOCAL
        // -----------------------------------------
        return Bien::find()
            ->where(['matricula' => $matricula])
            ->one();
    }


    /**
     * =========================================================
     * BUSCAR POR CÓDIGO DE BARRAS
     * =========================================================
     */
public function buscarPorCodigoBarras($codigo)
{
    $codigo = strtoupper(trim($codigo));

    /*
     * =========================================================
     * SICOPRO SIMULADO
     * =========================================================
     *
     * El código leído por el scanner corresponde al
     * número de serie / identificador único del bien.
     *
     * Ejemplo:
     *
     * CB123456789
     *
     * identifica al bien cuya matrícula es:
     *
     * 123456789
     *
     * y cuyo número de serie es:
     *
     * PF4X9K2L
     */

    if ($codigo === 'CB123456789') {

        return $this->bienSimulado();
    }


    /*
     * =========================================================
     * BÚSQUEDA REAL
     * =========================================================
     *
     * epan_bien NO tiene numero_serie ni codigo_barras.
     *
     * Por lo tanto NO hacemos:
     *
     * Bien::find()->where(['codigo_barras' => $codigo])
     *
     * porque esa columna no existe.
     *
     * La búsqueda real deberá hacerse posteriormente
     * contra SICOPRO.
     */

    return null;
}


    /**
     * =========================================================
     * OBTENER BIEN COMPLETO
     * =========================================================
     */
    public function obtenerBienCompleto($id)
    {
        // -----------------------------------------
        // SIMULACIÓN
        // -----------------------------------------
         return $this->bienSimulado();
        /*if ((int)$id === 999999) {
            return $this->bienSimulado();
        }*/

        // -----------------------------------------
        // BÚSQUEDA REAL LOCAL
        // -----------------------------------------
       /* return Bien::find()
            ->with(['personas'])
            ->where(['id' => $id])
            ->one();*/
    }
}