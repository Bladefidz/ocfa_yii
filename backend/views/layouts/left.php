<?php
use backend\models\UserCreate;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Admin Panel', 'options' => ['class' => 'header'], 'visible' => UserCreate::isAdmin()],
					['label' => 'User Panel', 'options' => ['class' => 'header'], 'visible' => !UserCreate::isAdmin()],
                    ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 'url' => ['/']],
                    [
                        'label' => 'Data Management',
                        'icon' => 'fa fa-files-o',
                        'url' => '#',
                        'items' => [
							['label' => 'Data Kependudukan', 'icon' => 'fa fa-circle-o', 'url' => ['/data'],],
							['label' => 'Statistik', 'icon' => 'fa fa-circle-o', 'url' => ['/gii'],],
							['label' => 'Arsip', 'icon' => 'fa fa-circle-o', 'url' => ['/gii'],],
                        ],
						'visible' => UserCreate::isAdmin()
                    ],
					[
                        'label' => 'User Management',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                            ['label' => 'User Data', 'icon' => 'fa fa-circle-o', 'url' => ['/user'],],
							['label' => 'User Activity', 'icon' => 'fa fa-circle-o', 'url' => ['/user-activity'],],
                        ],
						'visible' => UserCreate::isAdmin()
                    ],
					['label' => 'API Management', 'icon' => 'fa fa-link', 'url' => ['../web'],'visible' => UserCreate::isAdmin()],
					['label' => 'Pengaturan', 'icon' => 'fa fa-gear', 'url' => ['../web'],'visible' => UserCreate::isAdmin()],//'visible' => Yii::$app->user->isGuest
                ],
            ]
        ) ?>

    </section>

</aside>
