<?php

namespace app\models;

use yii\db\ActiveRecord;

class HistorialEscaneo extends ActiveRecord
{
    public static function tableName()
    {
        return 'epan_historial_escaneo';
    }

    public function rules()
    {
        return [
            [['usuario_id', 'patrimonio_id'], 'integer'],
            [['fecha_hora'], 'safe'],
            [['codigo'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 255],
        ];
    }
}