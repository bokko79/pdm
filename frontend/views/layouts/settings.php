<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

$model = isset($this->params['model']) ? $this->params['model'] : [];

$items = [];
$items[] = ['label' => 'Nalog home', 'url' =>['/user/security/home', 'username'=>$model->username], 'linkOptions'=>['style'=>'font-size:15px;']];
$items[] = '<li class="divider"></li>';

$items[] = ['label' => 'Nalog', 'url' =>['/user/security/account', 'username'=>$model->username]];       
$items[] = ['label' => 'Inženjer', 'url' =>['/engineers/update', 'id'=>$model->id]];             
$items[] = ['label' => 'Portfolio', 'url' =>['/user/security/account', 'username'=>$model->username]];           
$items[] = ['label' => 'Dokumetni', 'url' =>['/user/security/account', 'username'=>$model->username]];   
$items[] = ['label' => 'Licencni paketi', 'url' =>['/engineer-licences/create', 'username'=>$model->username]];   

?>

<?php $this->beginContent('@frontend/views/layouts/html/html.php'); ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <div class="row">

            <div class="col-sm-12">
                <?= $content ?>
            </div>
        </div>        
    </div>


<?php $this->endContent(); // HTML ?>
