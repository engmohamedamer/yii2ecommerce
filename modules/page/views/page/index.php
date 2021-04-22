<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\widgets\Alert;
use yii\helpers\Url;
use extended\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel page\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('page', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index card">

    <?php // $this->render('_search', ['model' => $searchModel]); ?>

    <div class="card-header">
        <?= Alert::widget() ?>
        <?php
		if(Yii::$app->user->can('createPage'))
            echo Html::a(Yii::t('page', 'Create Page'), ['create'], ['class' => 'btn btn-success']);
        ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'title_url',
                //'format'=>'url',
                'format'=>'raw',
                'value'=>function($data){
                    return Html::a($data->title_url, Yii::$app->urlManagerFrontend->createAbsoluteUrl(Url::to($data->url)));
                },
            ],
            'title',
            [
                'attribute'=>'text',
                'format'=>'raw',
                'value'=>function($data){
                    return StringHelper::truncate($data->text, 50);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'visibleButtons' => [
                    //'view' => true,
                    'view' => function ($model, $key, $index) {
                        return Yii::$app->user->can('viewPage', ['model' => $model]);
                    },
                    'update' => function ($model, $key, $index) {
                        return Yii::$app->user->can('updatePage', ['model' => $model]);
                    },
                    'delete' => function ($model, $key, $index) {
                        return Yii::$app->user->can('deletePage', ['model' => $model]);
                    },
                ],
            ],

        ],
    ]); ?>

</div>
