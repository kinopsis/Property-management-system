<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\grid\ActionColumn;
use app\components\grid\SetColumn;
use app\modules\admin\models\User;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ADMIN_USERS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        [
            'filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'date_from',
                'attribute2' => 'date_to',
                'type' => DatePicker::TYPE_RANGE,
                'separator' => '-',
                'pluginOptions' => ['format' => 'yyyy-mm-dd']
            ]),
            'attribute' => 'created_at',
            'format' => 'datetime',
        ],
        [
            'attribute' => 'username',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $column) {
                /** @var User $model */
            return Html::a(Html::encode($model->username), ['view', 'id' => $model->id]);
            }
        ],
        'email:email',
         [
            'class' => SetColumn::className(),
            'filter' => User::getStatusesArray(),
            'attribute' => 'status',
            'name' => 'statusName',
            'cssCLasses' => [
                User::STATUS_ACTIVE => 'success',
                User::STATUS_WAIT => 'warning',
                User::STATUS_BLOCKED => 'default',
            ],
        ],
        ['class' => ActionColumn::className()],
    ],
]); 

?>

</div>
