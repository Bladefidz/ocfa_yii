<?php
use yii\helpers\Html;
use common\models\DataManagement;
use common\models\User;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
	
	<nav class="navbar navbar-static-top">
	  <div class="container">
		<div class="navbar-header">
		  <a href="<?= Yii::$app->homeUrl;?>" class="navbar-brand"><b>OCFA System</b></a>
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
			<i class="fa fa-bars"></i>
		  </button>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
		  <ul class="nav navbar-nav">
			<li id="home"><a href="<?= Yii::$app->homeUrl;?>">Home <span class="sr-only">(current)</span></a></li>
			<li id="tentang"><a href="#about">Tentang OCFA</a></li>
			<li id="api_doc"><a href="#api">API</a></li>
			<!-- <li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li class="divider"></li>
				<li><a href="#">Separated link</a></li>
				<li class="divider"></li>
				<li><a href="#">One more separated link</a></li>
			  </ul>
			</li> -->
		  </ul>
		  <form class="navbar-form navbar-left" role="search">
			<div class="form-group">
			  <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
			</div>
		  </form>
		</div><!-- /.navbar-collapse -->
		<div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

				<?php 
				if (Yii::$app->user->isGuest) {
				?>
				<li class="">
                    <?= Html::a(
						'Log In',
						['/login'],
						['data-method' => 'post', 'class' => 'btn btn-flat']
					) ?>
                    
                </li>
				<?php
				}else{
				?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">
                            <?= DataManagement::findOne(['nik' => Yii::$app->user->getId()])->nama?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User header -->
                        <li class="user-header">
                            <p>
                                <?= DataManagement::findOne(['nik' => Yii::$app->user->getId()])->nama?>
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
				<?php } ?>
            </ul>
        </div>
	  </div><!-- /.container-fluid -->
	</nav>
</header>
