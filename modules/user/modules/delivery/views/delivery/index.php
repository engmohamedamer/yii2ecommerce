<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model delivery\models\DeliveryForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use user\models\User;
use user\assets\UserAsset;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;


UserAsset::register($this);


$this->title = 'Send email messages to users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact card">

   <div class="card-body">
       <div class="row">
           <div class="col-lg-12">
               <?php $form = ActiveForm::begin([
                   'id' => 'delivery-form',
                   'enableAjaxValidation'=>true,
                   'enableClientValidation'=>true,
               ]);
               ?>
               <?php
               $roles = (new User())->rolesValues;
               unset($roles[User::ROLE_GUEST]);
               echo $form->field($model, 'role')->checkboxList($roles);
               ?>




               <?php
               echo $form->field($model, 'subscribe')
                   ->checkboxList((new User())->subscribeValues);
               ?>


               <?php
               $query = User::find();
               if($model->role)
                   $query->rolesQuery($model->role);
               $allUsers = $query->all();
               $options = ArrayHelper::map($allUsers, function($user){
                   return $user->email.'|'.$user->fullName;
               }, 'fullName');
               ?>
               <?= $form->field($model, 'recipients')->dropDownList($options, [ 'multiple' => true, 'size' => 20 ]) ?>



               <?= $form->field($model, 'subject') ?>

               <?= $form->field($model, 'body')->widget(CKEditor::className(),[
                   'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                       'preset' => 'basic',
                       'inline' => false,
                       'resize_enabled'=>true,
                       'height'=>400,
                       'toolbarGroups'=>[['name' => 'editing', 'groups' => [ 'tools']],]
                   ]),
               ]); ?>

               <?= $form->field($model, 'type')->radioList($model->typeValues)->hint("
            Immediately method sends messages directly to emails.
            Later method sends messages accroding to cron tasks.
            "); ?>

               <div class="form-group">
                   <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
               </div>

               <?php ActiveForm::end(); ?>
           </div>
       </div>
   </div>

</div>
<?php
