<?php

namespace app\models;

use yii\db\ActiveRecord;

class Persona extends ActiveRecord
{
    public static function tableName()
    {
        return 'epan_persona';
    }
}
