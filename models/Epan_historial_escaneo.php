<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "epan_historial_escaneo".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int|null $patrimonio_id
 * @property string|null $codigo
 * @property string|null $descripcion
 * @property string $fecha_hora
 */
class Epan_historial_escaneo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epan_historial_escaneo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['patrimonio_id', 'codigo', 'descripcion'], 'default', 'value' => null],
            [['usuario_id'], 'required'],
            [['usuario_id', 'patrimonio_id'], 'integer'],
            [['fecha_hora'], 'safe'],
            [['codigo'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'patrimonio_id' => 'Patrimonio ID',
            'codigo' => 'Codigo',
            'descripcion' => 'Descripcion',
            'fecha_hora' => 'Fecha Hora',
        ];
    }

}
