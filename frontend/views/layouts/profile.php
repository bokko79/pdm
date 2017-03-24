<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$model = isset($this->params['profile']) ? $this->params['profile'] : [];
?>
<?php $this->beginContent('@frontend/views/layouts/html/html_profile.php'); ?>
        <?= (Yii::$app->controller->id=='engineers') ? $this->render('header/_profileheader', ['model'=>$model]) : $this->render('header/_practiceheader', ['model'=>$model]) ?>
                
        
    <div class="container" style="">
        <div class="row">
            <div class="col-sm-12">

                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>


<?php $this->endContent(); // HTML ?>
