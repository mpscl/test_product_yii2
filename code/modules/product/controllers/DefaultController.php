<?php

namespace app\modules\product\controllers;

use yii\web\Controller;

/**
 * Default controller for the `product` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $x=1;
        return $this->render('index');
    }
}
