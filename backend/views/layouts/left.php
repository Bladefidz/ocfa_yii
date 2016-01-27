<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Admin Panel', 'options' => ['class' => 'header']],
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
                    ],
					[
                        'label' => 'User Management',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                            ['label' => 'User Data', 'icon' => 'fa fa-circle-o', 'url' => ['/user'],],
							['label' => 'User Activity', 'icon' => 'fa fa-circle-o', 'url' => ['/gii'],],
                        ],
                    ],
					['label' => 'API Management', 'icon' => 'fa fa-link', 'url' => ['../web']],
					['label' => 'Pengaturan', 'icon' => 'fa fa-gear', 'url' => ['../web']],//'visible' => Yii::$app->user->isGuest
                ],
            ]
        ) ?>

    </section>

</aside>
