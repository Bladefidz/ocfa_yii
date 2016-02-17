<?php
use yii\helpers\Html;
use common\models\DataManagement;
use common\models\User;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">OCFA</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                
                <!-- User Account: style can be found in dropdown.less -->
		<?php
                    $base = DataManagement::findOne(['nik' => Yii::$app->user->getId()]);
                    $user = User::findOne(['id' => Yii::$app->user->getId()]);

                    if(!empty($base)) {
                        $name = $base->nama;
                    } else {
                        $name = $user->username;
                    }
                ?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">
                            <?= $name?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User header -->
                        <li class="user-header">
                            <p>
                                <?= $name?>
                                <small>Bergabung sejak <?= \Yii::$app->formatter->asDate(User::findOne(['id' => Yii::$app->user->getId()])->created_at,'php:d-M-Y');?></small>
                            </p>
							<p>
								<small>NIK Anda <?=Yii::$app->user->getId()?></small>
							</p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Pengaturan</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
