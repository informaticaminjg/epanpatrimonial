<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relevamientopat_bien_imagen".
 *
 * @property int $id
 * @property int $idrelevamientobien
 * @property string $imagen
 * @property string $fecha_creacion
 *
 * @property RelevamientopatBien $idrelevamientobien0
 */
class Relevamientopat_bien_imagen extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relevamientopat_bien_imagen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrelevamientobien', 'imagen'], 'required'],
            [['idrelevamientobien'], 'integer'],
            [['fecha_creacion'], 'safe'],
            [['imagen'], 'string', 'max' => 500],
            [['idrelevamientobien'], 'exist', 'skipOnError' => true, 'targetClass' => RelevamientopatBien::class, 'targetAttribute' => ['idrelevamientobien' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrelevamientobien' => 'Idrelevamientobien',
            'imagen' => 'Imagen',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    /**
     * Gets query for [[Idrelevamientobien0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdrelevamientobien0()
    {
        return $this->hasOne(RelevamientopatBien::class, ['id' => 'idrelevamientobien']);
    }

}
