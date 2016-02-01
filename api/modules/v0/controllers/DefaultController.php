<?php

namespace api\modules\v0\controllers;

use yii\web\Controller;

/**
 * Default controller for the `app-api` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        echo "hello";
    }
}
