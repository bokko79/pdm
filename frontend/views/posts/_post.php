
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

$formatter = \Yii::$app->formatter;
?>



	<div class="card_container record-25 grid-item fadeInUp animated" id="card_container" style="float:; box-shadow: 0px 0px 7px 0px #bbb;">
        <a href="<?= Url::to('/posts/view?id='.$model->id) ?>">
            <?php if($model->file): ?>
            <div class="media-area dark">                
                <div class="image">
                    <?= Html::img('@web/images/posts/'.$model->file->name) ?>                   
                </div>
                <div class="primary-context in-media dark">
                    <div class="head lower"><?= Html::encode(c($model->title)) ?></div>
                    <div class="subhead"><i class="fa fa-newspaper-o"></i> <?= Html::encode(c($model->subtitle)) ?></div>
                </div>
            </div>
        <?php else: ?>

            <div class="primary-context">
                <div class="subhead"><?= $model->user->username ?></div>
                <div class="head third"><?= Html::encode(c($model->title)) ?></div>
                <div class="subhead"><i class="fa fa-newspaper-o"></i> <?= Html::encode(c($model->subtitle)) ?></div>
            </div>
            <div class="secondary-context">
                <div><?= HtmlPurifier::process($model->excerpt) ?></div>
                <?= $formatter->asDate($model->time, 'php: F Y.') ?>
            </div>
        <?php endif; ?>
        </a>
    </div>
        