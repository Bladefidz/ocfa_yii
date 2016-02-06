<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * UserCreate
 */
class UserCreate extends Model
{
    public $username;
    public $email;
    public $password;
	public $id;

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
            ['id', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['id', 'string', 'min' => 16, 'max' => 16],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
	
	/**
     * @inheritdoc
     */
	public function attributeLabels()
    {
        return [
            'id' => 'NIK',
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
        $user->username = $this->username;
        $user->email = $this->email;
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
