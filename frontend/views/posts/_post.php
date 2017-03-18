
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;


?>



	<div class="card_container record-full fadeInUp animated" id="card_container" style="float:none; border-left-color: green !important; margin: 15px 0 !important; box-shadow: 0px 0px 7px 0px #bbb;">
        <a href="<?= Url::to('/posts/view?id='.$model->id) ?>">
            
            <table class="main-context"> 
                <tr>
                    <td class="body-area">
                        <div class="primary-context">
                            <div class="head"><i class="fa fa-newspaper-o"></i> <?= Html::encode(c($model->title)) ?></div>
                            <div class="subhead"><i class="fa fa-newspaper-o"></i> <?= Html::encode(c($model->subtitle)) ?></div>
                        </div>
                        <div class="secondary-context cont">
                            <?= HtmlPurifier::process($model->excerpt) ?>
                        </div>
                    </td>
                    <td class="media-area">
                        <div >                
                            <div class="image">
                                <?= $model->file ? Html::img('@web/images/posts/'.$model->file->name) : null ?>
                            </div>
                        </div> 
                    </td>
                </tr>                        
            </table>
        </a>
    </div>  <?php /* 

    <div class="card_container record-md grid-item fadeInUp animated" style="">
        <a href="<?= Url::to('/posts/view?id='.$model->id) ?>">
            <div class="media-area">                
                <div class="image">
                    <?= $model->file ? Html::img('@web/images/posts/'.$model->file->name) : null ?>                
                </div>
                <div class="primary-context in-media dark">
                    <div class="head"><i class="fa fa-newspaper-o"></i> <?= Html::encode(c($model->title)) ?></div>
                </div>
            </div>
            <div class="primary-context">
                <div class="subhead"><?= \yii\helpers\StringHelper::truncate(Html::encode(c($model->subtitle)),40) ?></div>
            </div>
            <div class="secondary-context">
                <?= \yii\helpers\StringHelper::truncate(HtmlPurifier::process($model->excerpt),100) ?>
            </div>
        </a>
    </div> */ ?>
        