<?php
namespace frontend\models;

use common\models\User;
use common\models\DataManagement;
use yii\base\Model;
use yii\helpers\VarDumper;
use Yii;

/**
 * UserCreate
 */
class SignupForm extends Model
{
    const LEVEL_INTERNAL_NON_PEMERINTAH = 0;
    const LEVEL_ADMIN = 1;
    const LEVEL_INTERNAL_PEMERINTAH = 2;
    const LEVEL_EKSTERNAL_NON_PEMERINTAH = 3;
    const LEVEL_EKSTERNAL_PEMERINTAH = 4;

    public $username;
    public $email;
    public $password;
    public $instansi;
    public $id;
    public $telp;
    public $level;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['id', 'filter', 'filter' => 'trim'],
            ['id', 'required'],
            ['id', 'exist', 'targetClass' => '\common\models\DataManagement', 'targetAttribute' => 'nik', 'message' => 'NIK anda tidak terdaftar di database kependudukan. Silahkan hubungi kantor dukcapil terdekat untuk melakukan validasi identitas kependudukan anda.'],
            ['id', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['id', 'string', 'min' => 16, 'max' => 16],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['telp', 'required'],
            ['telp', 'string', 'length' => [5, 20]],

            ['instansi', 'required'],
            ['instansi', 'string', 'max' => 20],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['level', 'default', 'value' => self::LEVEL_EKSTERNAL_NON_PEMERINTAH],
            ['level', 'in', 'range' => [self::LEVEL_INTERNAL_NON_PEMERINTAH, self::LEVEL_ADMIN, self::LEVEL_INTERNAL_NON_PEMERINTAH, self::LEVEL_EKSTERNAL_NON_PEMERINTAH, self::LEVEL_EKSTERNAL_PEMERINTAH]],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'NIK',
            'telp' => 'Telephone',
            'instansi' => 'Nama Instansi'
            ];
    }
    
    /**
     * Find user
     * @param string id
     * @return User model
     */
    public function findUser($id)
    {
        return User::findOne($id);
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->id = $this->id;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->telp = $this->telp;
        $user->instansi = $this->instansi;
        $user->status = 20;
        $user->level = $this->level;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
    
    /**
     * is Admin?
     * @param string $id
     * @return boolean
     */
    public function isAdmin()
    {
        $user = User::findIdentity(Yii::$app->user->id);
        return $user->level == 1 ? true : false;
    }
}
