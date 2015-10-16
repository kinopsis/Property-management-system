<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\components\widgets\Alert;
use app\assets\AppAsset;
use yii\helpers\Url;

Yii::$app->LangChange->index();

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::tag('aside', Html::img('/logo.png',['alt' =>  Yii::$app->name]).' '.Html::tag('span',  Yii::$app->name), ['class' => '']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'activateParents' => true,
    'items' => array_filter([
        ['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']],
        ['label' => Yii::t('app', 'NAW_OBJECTS'), 'url' => ['/objects/default/index']],
        ['label' => Yii::t('app', 'NAW_CONTACT'), 'url' => ['/main/contact/index']],
        Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/default/signup']] :
            false,
        Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']] :
            false,        
        !Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_PROFILE'), 'items' => [
                ['label' => Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/profile/index']],
                ['label' => Yii::t('app', 'NAV_LOGOUT'),
                    'url' => ['/user/default/logout'],
                    'linkOptions' => ['data-method' => 'post']]
            ]] :
            false,
            ['label' => Yii::t('app', 'NAV_LANGUAGE'), 'items' => [
                ['label' => Yii::t('app', 'NAV_RUSSIAN'), 'url' => Url::current(['lang' => 'RU'])],
                ['label' => Yii::t('app', 'NAV_ENGLISH'),  'url' => Url::current(['lang' => 'EN'])],
            ]],
            Yii::$app->user->can('admin') ?
            ['label' => Yii::t('app', 'NAV_ADMIN'), 'options' => ['class' =>'RED'], 'items' => [
                ['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
                ['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['/admin/users/index']],
            ]] :
            false,
    ]),
]);

    NavBar::end(); 
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?></p>
        <p class="pull-right"><?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
