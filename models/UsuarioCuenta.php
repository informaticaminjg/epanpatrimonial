<?php

namespace app\models;

use yii\db\ActiveRecord;

class UsuarioCuenta extends ActiveRecord
{
    public static function tableName()
    {
        return 'epan_usuario_cuenta';
    }

    public function rules()
    {
        return [
            [['nombre', 'email', 'dependencia', 'telefono'], 'string', 'max' => 150],
            [['email'], 'email'],
        ];
    }
}
