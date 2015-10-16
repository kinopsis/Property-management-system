<?php

namespace app\modules\objects\controllers;

use yii\web\Controller;
use yii\rest\ActiveController;

class DefaultController extends ActiveController
{
    // указываем класс модели, который будет использоваться
    public $modelClass = 'app\modules\objects\models\Objects';
 
    public function behaviors()
    {
        return 
        \yii\helpers\ArrayHelper::merge(parent::behaviors(), [             
            'corsFilter' => [ 
                'class' => \yii\filters\Cors::className(),                           
            ],            
        ]);
    }

   

}

