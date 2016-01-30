<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
<<<<<<< HEAD
    public $no_telp;
    public $app_name;
    public $corp_name;
    public $corp_telp;
    public $corp_email;
    public $corp_prov;
    public $corp_region;
    public $corp_district;
    public $corp_address;
=======
	public $id;
	public $instansi;
	public $telp;
>>>>>>> origin/master

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'required'],
            ['id', 'string', 'min' => 16, 'max' => 16],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
<<<<<<< HEAD

            ['no_telp', 'filter', 'filter' => 'trim'],
            ['no_telp', 'required'],
=======
			
			['id', 'required'],
            ['id', 'integer', 'min' => 16, 'max' => 16],
			
			['instansi', 'required'],
            ['instansi', 'string', 'max' => 50],
			
			['telp', 'required'],
            ['telp', 'string', 'max' => 20],
>>>>>>> origin/master
        ];
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
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
