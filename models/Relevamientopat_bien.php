<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relevamientopat_bien".
 *
 * @property int $id
 * @property int $idrelevamiento
 * @property string $matricula
 * @property string|null $persona_cargo
 * @property string|null $lugar_pertenece
 * @property string $estado_bien
 *
 * @property Relevamientopat $idrelevamiento0
 * @property RelevamientopatBienImagen[] $relevamientopatBienImagens
 */
class Relevamientopat_bien extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relevamientopat_bien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persona_cargo', 'lugar_pertenece'], 'default', 'value' => null],
            [['idrelevamiento', 'matricula', 'estado_bien'], 'required'],
            [['idrelevamiento'], 'integer'],
            [['matricula'], 'string', 'max' => 50],
            [['persona_cargo', 'lugar_pertenece'], 'string', 'max' => 255],
            [['estado_bien'], 'string', 'max' => 100],
            [['idrelevamiento'], 'exist', 'skipOnError' => true, 'targetClass' => Relevamientopat::class, 'targetAttribute' => ['idrelevamiento' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrelevamiento' => 'Idrelevamiento',
            'matricula' => 'Matricula',
            'persona_cargo' => 'Persona Cargo',
            'lugar_pertenece' => 'Lugar Pertenece',
            'estado_bien' => 'Estado Bien',
        ];
    }

    /**
     * Gets query for [[Idrelevamiento0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdrelevamiento0()
    {
        return $this->hasOne(Relevamientopat::class, ['id' => 'idrelevamiento']);
    }

    /**
     * Gets query for [[RelevamientopatBienImagens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelevamientopatBienImagens()
    {
        return $this->hasMany(RelevamientopatBienImagen::class, ['idrelevamientobien' => 'id']);
    }

}
