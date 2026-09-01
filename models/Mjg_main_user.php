<?php

namespace app\models;

use Yii;

use yii\web\IdentityInterface;
/**
 * This is the model class for table "mjg_main_user".
 *
 * @property int $iduser
 * @property string $username
 * @property string $password
 * @property string|null $backpass
 * @property string $email1
 * @property string|null $email2
 * @property int $activo 0: no activo; 1: activo
 * @property int $attemps
 * @property int $externo 0:no 1:si 2: desconocido
 * @property string|null $profile nombre de imagen
 * @property int|null $idpersona
 * @property string $fechacreate
 * @property string $fechaupdate
 * @property int|null $usercreate
 * @property int|null $userupdate
 * @property string|null $whitening_code
 * @property string|null $reset_code
 * @property int|null $admin 0: no es administrador  1: es administrador
 *
 * @property MjgAuxNotificacionUser[] $mjgAuxNotificacionUsers
 * @property MjgAuxNotificacionUser[] $mjgAuxNotificacionUsers0
 * @property MjgEquipo[] $mjgEquipos
 * @property MjgEquipo[] $mjgEquipos0
 * @property MjgMainReporteWidget[] $mjgMainReporteWidgets
 * @property MjgMainWidget[] $mjgMainWidgets
 * @property MjgPatrimonioAdjImg[] $mjgPatrimonioAdjImgs
 * @property StockMovimiento[] $stockMovimientos
 * @property StockStockUsuario[] $stockStockUsuarios
 * @property StockStock[] $stocks
 */
class Mjg_main_user extends \yii\db\ActiveRecord implements IdentityInterface
{

    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mjg_main_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['backpass', 'email2', 'idpersona', 'usercreate', 'userupdate', 'whitening_code', 'reset_code'], 'default', 'value' => null],
            [['admin'], 'default', 'value' => 0],
            [['profile'], 'default', 'value' => ''],
            [['username', 'password', 'email1', 'activo', 'externo', 'fechacreate', 'fechaupdate'], 'required'],
            [['activo', 'attemps', 'externo', 'idpersona', 'usercreate', 'userupdate', 'admin'], 'integer'],
            [['fechacreate', 'fechaupdate'], 'safe'],
            [['username', 'backpass', 'email1', 'email2', 'profile'], 'string', 'max' => 254],
            [['password'], 'string', 'max' => 255],
            [['whitening_code', 'reset_code'], 'string', 'max' => 200],
        ];
    }
    public function getAuthKey()
    {
        return hash('sha256', 'epan-patrimonial-' . $this->iduser);
    }

    public function validateAuthKey($authKey)
    {
        return hash_equals($this->getAuthKey(), $authKey);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iduser' => 'Iduser',
            'username' => 'Username',
            'password' => 'Password',
            'backpass' => 'Backpass',
            'email1' => 'Email1',
            'email2' => 'Email2',
            'activo' => 'Activo',
            'attemps' => 'Attemps',
            'externo' => 'Externo',
            'profile' => 'Profile',
            'idpersona' => 'Idpersona',
            'fechacreate' => 'Fechacreate',
            'fechaupdate' => 'Fechaupdate',
            'usercreate' => 'Usercreate',
            'userupdate' => 'Userupdate',
            'whitening_code' => 'Whitening Code',
            'reset_code' => 'Reset Code',
            'admin' => 'Admin',
        ];
    }

    /**
     * Gets query for [[MjgAuxNotificacionUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMjgAuxNotificacionUsers()
    {
        return $this->hasMany(MjgAuxNotificacionUser::class, ['from' => 'iduser']);
    }

    /**
     * Gets query for [[MjgAuxNotificacionUsers0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMjgAuxNotificacionUsers0()
    {
        return $this->hasMany(MjgAuxNotificacionUser::class, ['to' => 'iduser']);
    }

    /**
     * Gets query for [[MjgEquipos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMjgEquipos()
    {
        return $this->hasMany(MjgEquipo::class, ['user_create' => 'iduser']);
    }

    /**
     * Gets query for [[MjgEquipos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMjgEquipos0()
    {
        return $this->hasMany(MjgEquipo::class, ['user_update' => 'iduser']);
    }

    /**
     * Gets query for [[MjgMainReporteWidgets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMjgMainReporteWidgets()
    {
        return $this->hasMany(MjgMainReporteWidget::class, ['iduser' => 'iduser']);
    }

    /**
     * Gets query for [[MjgMainWidgets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMjgMainWidgets()
    {
        return $this->hasMany(MjgMainWidget::class, ['id_user' => 'iduser']);
    }

    /**
     * Gets query for [[MjgPatrimonioAdjImgs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMjgPatrimonioAdjImgs()
    {
        return $this->hasMany(MjgPatrimonioAdjImg::class, ['userupload' => 'iduser']);
    }

    /**
     * Gets query for [[StockMovimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockMovimientos()
    {
        return $this->hasMany(StockMovimiento::class, ['usuario_id' => 'iduser']);
    }

    /**
     * Gets query for [[StockStockUsuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockStockUsuarios()
    {
        return $this->hasMany(StockStockUsuario::class, ['usuario_id' => 'iduser']);
    }

    
    /**
     * Gets query for [[Stocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(StockStock::class, ['id' => 'stock_id'])->viaTable('stock_stock_usuario', ['usuario_id' => 'iduser']);
    }

    public static function findIdentity($id): ?static
{
    return static::findOne(['iduser' => $id]);
}

public static function findIdentityByAccessToken($token, $type = null): ?static
{
    return null;
}

public function getId(): int|string
{
    return $this->iduser;
}


public static function findByUsername(string $username): ?static
{
    return static::find()
        ->where(['username' => $username])
        ->andWhere(['activo' => 1])
        ->one();
}
}
