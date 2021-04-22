<?php
use yii\widgets\Breadcrumbs;
/*use \hail812\adminlte3\widgets\Alert;*/
use common\widgets\Alert;
use yii\helpers\Html;
use \yii\helpers\Inflector;
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

          <div class="row mb-2">
            <div class="col-sm-6">
                <?php if (isset($this->blocks['content-header'])) { ?>
                  <h1><?= $this->blocks['content-header'] ?></h1>
                <?php } else { ?>

                  <h1>
                      <?php
                      if ($this->title)
                          echo $this->title;
                      elseif(isset($this->params['title']))
                          echo $this->params['title'];
                      else{
                          echo Inflector::camel2words(
                              Inflector::id2camel($this->context->module->id)
                          );
                          echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                      }
                      ?>
                  </h1>
                <?php } ?>
            </div>
            <div class="col-sm-6">
                <?=
                Breadcrumbs::widget(
                    [
                        'homeLink'=>[
                            'label'=>Yii::t('common', 'Home'),
                            'url'=>['/'],
                        ],
                        'options'=>['class' => 'breadcrumb float-sm-right'],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'encodeLabels'=>false,
                        'itemTemplate'=>"<li class='breadcrumb-item'>{link}</li>\n",
                        'activeItemTemplate'=>"<li class='breadcrumb-item active'>{link}</li>\n",
                    ]
                ) ?>

            </div>
          </div>






        </div>

    </section>

    <section class="content">
        <div class="container-fluid">
            <?php echo Alert::widget() ?>
            <?= $content ?>
            <div class="clear"></div>
        </div>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <!--<b>Version</b> 1.0-->
    </div>
    Copyright &copy; 2018 <?=Yii::$app->name?>
    All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Settings tab content -->
        <div class="active tab-pane" id="control-sidebar-settings-tab">
            <h3 class="control-sidebar-heading">General Settings</h3>

            <?php
            $items = [
                ['label' => 'My profile', 'url' => ['/user/profile/profile']],
                ['label' => 'Edit profile', 'url' => ['/user/profile/edit-profile',]],
                ['label' => 'Change email', 'url' => ['/user/profile/change-email']],
                Yii::$app->user->identity->password_hash ? ['label' => 'Change password', 'url' => ['/user/profile/change-password']]:['label' => 'Set password', 'url' => ['/user/profile/set-password']],
                ['label' => 'Share link to register', 'url' => ['/user/profile/share',]],
                ['label' => 'Invite to register', 'url' => ['/user/profile/invite',]],
                ['label' =>
                    'Logout',
                    'url' => ['/user/profile/logout'],
                    'linkOptions' => ['data-method' => 'post']],
            ];
            foreach ($items as $item){
                $item['linkOptions']['style']='color:inherit';
                ?>
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        <?=Html::a($item['label'], $item['url'], $item['linkOptions'])?>
                    </label>
                </div>
                <?php
            }
            ?>
            <!--<div class="form-group">
                <label class="control-sidebar-subheading">
                    Report panel usage
                    <input type="checkbox" class="pull-right" checked/>
                </label>
                <p>
                    Some information about this general settings option
                </p>
            </div>-->
            <!-- /.form-group -->


        </div>
        <!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>