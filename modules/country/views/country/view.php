<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model country\models\Country */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('country', 'Countries'), 'url' => [Yii::$app->controller->defaultAction]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-view card">


    <div class="card-header">
        <?php
		if(Yii::$app->user->can('updateCountry', ['model' => $model]))
            echo Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        ?>
        <?php
        if(Yii::$app->user->can('deleteCountry', ['model' => $model]))
            echo Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        ?>
    </div>

    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'short_name',
                'name',
            ],
        ]) ?>
    </div>


</div>
