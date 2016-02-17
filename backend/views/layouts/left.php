<?php
use backend\models\UserCreate;
$user = new UserCreate();
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Admin Panel', 'options' => ['class' => 'header'], 'visible' => $user->isAdmin()],
					['label' => 'User Panel', 'options' => ['class' => 'header'], 'visible' => !$user->isAdmin()],
                    ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 'url' => ['../admin']],
					['label' => 'Access Log', 'icon' => 'fa fa-exchange', 'url' => ['/api-logs'],'visible' => !$user->isAdmin()],
                    [
                        'label' => 'Data Management',
                        'icon' => 'fa fa-files-o',
                        'url' => '#',
                        'items' => [
							['label' => 'Data Kependudukan', 'icon' => 'fa fa-circle-o', 'url' => ['/data'],],
							['label' => 'Data Keluarga', 'icon' => 'fa fa-circle-o', 'url' => ['/keluarga'],],
							['label' => 'Statistik', 'icon' => 'fa fa-circle-o', 'url' => ['/statistik'],],
							['label' => 'Arsip', 'icon' => 'fa fa-circle-o', 'url' => ['/arsip'],],
                        ],
						'visible' => $user->isAdmin()
                    ],
					[
                        'label' => 'User Management',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                            ['label' => 'User Data', 'icon' => 'fa fa-circle-o', 'url' => ['/user'],],
							['label' => 'User Activity', 'icon' => 'fa fa-circle-o', 'url' => ['/user-activity'],],
                        ],
						'visible' => $user->isAdmin()
                    ],
					[
                        'label' => 'API Management',
                        'icon' => 'fa fa-link',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Registration', 'icon' => 'fa fa-circle-o', 'url' => ['/registration'],],
							['label' => 'Access Control', 'icon' => 'fa fa-circle-o', 'url' => ['/api-access'],],
							['label' => 'Access Log', 'icon' => 'fa fa-circle-o', 'url' => ['/api-logs'],],
                        ],
						'visible' => $user->isAdmin()
                    ],
					['label' => 'Pengaturan', 'icon' => 'fa fa-gear', 'url' => ['/pengaturan']],
					//['label' => 'Pengaturan', 'icon' => 'fa fa-gear', 'url' => ['../web'],'visible' => !$user->isAdmin()],//'visible' => Yii::$app->user->isGuest
                ],
            ]
        ) ?>

    </section>

</aside>
