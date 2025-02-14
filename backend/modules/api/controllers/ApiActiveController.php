<?php
namespace app\modules\api\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class ApiActiveController extends ActiveController
{
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    /*public function behaviors()
    {
        $behaviors = parent::behaviors();
        // enabled HttpBearerAuth
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            ];
        return $behaviors;
    }*/
}