<?php
namespace frontend\models;

use common\models\User;
use common\models\UserPublic;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $no_telp;
    public $upload_tdp;
    public $userId;
    private $user;
    private $userPublic;

    /**
     * [__construct description]
     */
    public function __construct() {
        $this->user = new User();
        $this->userPublic = new UserPublic();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge($this->user->rules(), $this->userPublic->rules());
    }

    /**
     * [attributeLabels description]
     * @return [type] [description]
     */
    public function attributeLabels()
    {
        return array_merge($this->user->attributeLabels(), $this->userPublic->attributeLabels());
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        $status = false;

        if ($this->user->load(Yii::$app->request->post()) && $this->userPublic->load(Yii::$app->request->post()) && Model::validateMultiple([$this->user, $this->userPublic]) ) {
            $this->user->setPassword($this->password);
            $this->user->generateAuthKey();
            $this->user->status = 0;
            $this->user->level = 0;
            if ($this->userId = $this->user->save()) {
                $this->userPublic->nik = $this->userId;
                $fn = $this->userPublic->nama_instansi;
                $this->userPublic->upload_tdp = UploadedFile::getInstance($this->userPublic, 'upload_tdp');
                $fpath = 'uploads/' . $fn . '.' . $this->userPublic->upload_tdp->extension;
                $this->userPublic->upload_tdp->saveAs($fpath);
                $this->scan_tdp = $fpath;
                if ($this->userPublic->save()) {
                    $status = true;
                }
            }
        }

        return $status;
    }

    /**
     * [upload description]
     * @return [type] [description]
     */
    public function upload()
    {
        $image = UploadedFile::getInstance($this, 'upload_tdp');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // generate random name for the file
        $this->pic = time(). '.' . $image->extension;

        // the uploaded image instance
        return $image;
    }
}
