<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model user\models\User */

$this->title = Yii::t('user', 'Update User') . ' ' . $model->fullName;

$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="user-update">


    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
                'profile' => $profile,
            ]) ?>
        </div>
    </div>

</div>
