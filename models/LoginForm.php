<?php

declare(strict_types=1);

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Security;

class LoginForm extends Model
{
    public string $username = '';
    public string $password = '';
    public bool $rememberMe = false;

    private Mjg_main_user|null $_user = null;
    private bool $_userLoaded = false;

    public function __construct(
        private readonly Security $security,
        $config = []
    ) {
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
           
            [['username'], 'required', 'message' => 'El usuario es obligatorio.'],
            [['password'], 'required', 'message' => 'La contraseña es obligatoria.'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword(
            string $attribute,
            array|null $params
        ): void {
            if (!$this->hasErrors()) {

                $user = $this->getUser();

                $hash_sha256 = hash('sha256', $this->password);

                if (
                    !$user ||
                    $hash_sha256 !== $user->password
                ) {
                    $this->addError(
                        $attribute,
                        'Usuario o contraseña incorrectos.'
                    );
                }
            }
        }
    public function login(): bool
    {
        if ($this->validate()) {

            return Yii::$app->user->login(
                $this->getUser(),
                $this->rememberMe ? 3600 * 24 * 30 : 0
            );
        }

        return false;
    }

    public function getUser(): Mjg_main_user|null
    {
        if (!$this->_userLoaded) {

            $this->_user = Mjg_main_user::findByUsername(
                $this->username
            );

            $this->_userLoaded = true;
        }

        return $this->_user;
    }
}