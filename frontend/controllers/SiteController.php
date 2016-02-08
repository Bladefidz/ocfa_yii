<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use common\models\UserPublic;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
					'user' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new SignupForm();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			$this->writeLog('Melakukan Login');
            return $this->redirect('/ocfa_yii/admin');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
	
	/**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionUser($id)
    {
        $user = BaseUpdatable::findOne($id)->foto;
		echo '<img src="'.$user.'" width="320px"/>';
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionTentang()
    {
        return $this->render('tentang');
    }

    /**
     * [actionApi description]
     * @return [type] [description]
     */
    public function actionApidoc()
    {
        return $this->render('api_doc');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $user = new User();
        $userPublic = new UserPublic();

        if ($user->load(Yii::$app->request->post()) && $userPublic->load(Yii::$app->request->post()) && Model::validateMultiple([$user, $userPublic]) ) {
            $user->setPassword($user->password);
            $user->generateAuthKey();
            $user->status = 0;
            $user->level = 0;
            if ($userId = $user->save()) {
                if ($userPublic->load(Yii::$app->request->post())) {
                    $userPublic->nik = $userId;
                    $fn = $userPublic->nama_instansi;
                    $userPublic->upload_tdp = UploadedFile::getInstance($userPublic, 'upload_tdp');
                    $fpath = 'uploads/' . $fn . '.' . $userPublic->upload_tdp->extension;
                    $userPublic->upload_tdp->saveAs($fpath);
                    $userPublic->scan_tdp = $fpath;
                    if ($userPublic->save()) {
                        if (Yii::$app->getUser()->login(userId)) {
                            return $this->goHome();
                        }
                    }
                }
            }
        } else {
            return $this->render('signup', [
                'user' => $user,
                'userPublic' => $userPublic
            ]);
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

	/*
	 * Write to table log
	 *
	 * @param string $action
	 */
	public function writeLog($action){
		$activity = new UserActivity();
		$activity->nik = Yii::$app->user->id;
		$activity->action = $action;
		$activity->save();
	}
}
