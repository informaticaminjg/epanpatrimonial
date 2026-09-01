<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relevamientopat".
 *
 * @property int $id
 * @property string $fecha_creacion
 * @property int $idpersona
 * @property string $lugar_relevamiento
 * @property float|null $latitud
 * @property float|null $longitud
 * @property string|null $descripcion
 *
 * @property RelevamientopatBien[] $relevamientopatBiens
 */
class Relevamientopat extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relevamientopat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitud', 'longitud', 'descripcion'], 'default', 'value' => null],
            [['fecha_creacion'], 'safe'],
            [['idpersona', 'lugar_relevamiento'], 'required'],
            [['idpersona'], 'integer'],
            [['latitud', 'longitud'], 'number'],
            [['descripcion'], 'string'],
            [['lugar_relevamiento'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_creacion' => 'Fecha Creacion',
            'idpersona' => 'Idpersona',
            'lugar_relevamiento' => 'Lugar Relevamiento',
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[RelevamientopatBiens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelevamientopatBiens()
    {
        return $this->hasMany(RelevamientopatBien::class, ['idrelevamiento' => 'id']);
    }

}
