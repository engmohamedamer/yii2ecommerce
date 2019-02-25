<?php

/* @var $this \extended\view\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\ArrayHelper;
use common\assets\CommonAsset;
use frontend\assets\FrontendAppAsset;
use themes\sakura\assets\SakuraThemeAsset;
use common\assets\BootboxAsset;
use \common\assets\NotifyAsset;
use \common\assets\PerfectScrollbarAsset;
use common\assets\LightboxAsset;
use yii\grid\GridViewAsset;
use extended\vendor\BootstrapSelectAsset;
use themes\bootstrap\assets\BootstrapThemeAsset;
use yii\helpers\Url;

FrontendAppAsset::register($this);
CommonAsset::register($this);
BootboxAsset::register($this);
NotifyAsset::register($this);
PerfectScrollbarAsset::register($this);
LightboxAsset::register($this);
GridViewAsset::register($this);
BootstrapSelectAsset::register($this);

if(isset($this->assetManager->bundles['all']))
    $this->clearAssetBundle(BootstrapThemeAsset::class);
$themeBundle = BootstrapThemeAsset::register($this);
$this->theme->baseUrl = $themeBundle->baseUrl;


if(!isset($this->params['title'])){
    if($this->title)
        $this->params['title'] = $this->title;
    else
        $this->params['title'] = Yii::t('common', Yii::$app->name);
}
if(!isset($this->params['keywords']))
    $this->params['keywords'] = 'ecommerce, yii2, php, shop, store, cms, platform';
if(!isset($this->params['description']))
    $this->params['description'] = Yii::t('common', 'Ecommerce platform based on Yii2 PHP Framework');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="shortcut icon" href="<?=$themeBundle->baseUrl;?>/images/favicon.ico" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <meta name="robots" content="index, follow" />
    <meta name="author" content="Nurbek Nurjanov">
    <meta name="keywords" content="<?=$this->params['keywords']?>">
    <meta name="description" content="<?=$this->params['description']?>">
    <title><?= $this->params['title'] ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $items = require(Yii::getAlias('@themes').'/menuItems.php');
    $brandLabel= false;
    $route = Yii::$app->controller->route;
    if($route!='site/index'
        /*&& $route!='product/product/list'
        && $route!='product/product/view'*/
    )
        $brandLabel = $this->title;

    NavBar::begin([
        'brandLabel' => $brandLabel,
        'brandOptions'=>['style'=>'padding:15px; color:white;'],
        'brandUrl' => Url::to(['/']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);



    echo Nav::widget([
        'encodeLabels'=>false,
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $items['leftItems'],
    ]);
    echo Nav::widget([
        'encodeLabels'=>false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items['rightItems'],
    ]);
    NavBar::end();
    ?>

    <div class="container" style="margin-top: 60px;">
        <?=$this->yieldContent($content);;?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"> <label><?=Yii::t('common', 'Contacts')?></label> <br/>
            <i class="glyphicon glyphicon-envelope"></i> nurbek.nurjanov@mail.ru <br>
            <i class="glyphicon glyphicon-phone-alt" style="top:0"></i> <span>+996 558 01-14-77</span>
        </p>

        <p class="pull-right"><?=Yii::$app->name?><br> <?=Yii::t('common', 'All rights reserved');?> &copy; 2018</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
