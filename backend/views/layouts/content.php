<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
		<div class="row">
			<div class='container'>
				<?= Alert::widget() ?>
				<?= $content ?>
			</div>
		</div>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        Supported by <a href="http://www.yiiframework.com/">Yii</a> <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2015-<?=date('Y');?> <a href="#">OCFA System</a>.</strong> All rights
    reserved.
</footer>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>