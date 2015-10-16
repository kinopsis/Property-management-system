<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\web\Session;

class LangChange extends Component
{
 	public function index()
 {	

	$session = new Session;
	$session->open();

  	 	switch ($_GET['lang']){
            case 'RU':
                \Yii::$app->language = "ru";
                $session->set('lang', 'ru');
                break;
            case 'EN':
                \Yii::$app->language = "en";
                $session->set('lang', 'en');
                break;
        }

    if(!empty(\Yii::$app->session["lang"])){
    	Yii::$app->language = \Yii::$app->session["lang"];
	}

 }
 
}