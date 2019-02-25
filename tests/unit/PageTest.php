<?php

use yii\web\Request;
use yii\helpers\Url;
use tests\unit\fixtures\CategoryFixture;
use category\models\Category;
use tests\unit\fixtures\PageFixture;

class PageTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'pages' => [
                'class' => PageFixture::class,
                'depends'=>[],
            ]
        ];
    }

    public function _before()
    {
    }

    protected function _after()
    {
    }


    public function testCreateUrl()
    {
        $page = $this->tester->grabFixture('pages', 0);

        Yii::$app->urlManager->showScriptName=false;
        $this->tester->assertEquals(Url::to(['/page/page/view', 'url'=>$page->url]), '/'.$page->url);
    }
    public function testParseUrl()
    {
        $page = $this->tester->grabFixture('pages', 0);


        $request = Yii::$app->request;
        $request->setPathInfo($page->url);
        $request->resolve();

        $this->tester->assertNotNull($request->get('id'));
        $this->tester->assertEquals($request->get('id'), $page->id);
    }


}