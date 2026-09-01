<?php

namespace app\models;

use yii\db\ActiveRecord;

class Bien extends ActiveRecord
{
    public static function tableName()
    {
        return 'epan_bien';
    }

    public function getPersonas()
    {
        return $this->hasMany(Persona::class, ['id' => 'persona_id'])
            ->viaTable('epan_bien_persona', ['bien_id' => 'id']);
    }
}
