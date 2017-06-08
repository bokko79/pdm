<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<div class="card_container record-full grid-item fadeInUp no-shadow animated-not" id="">         
    <div class="secondary-context center">
        <?= Html::img('@web/images/icons/project-icon-14.png', ['style'=>'']) ?>
        <p>Lako do precizne projektne dokumentacije.</p>
    </div>
    <div class="secondary-context">
        <?= Html::a('<i class="fa fa-sign-up"></i>&nbsp;'.Yii::t('app', 'Registracija'), Url::to(['/user/registration/register']), ['class'=>'btn btn-info btn-block', 'style'=>'']) ?>                          
    </div>
</div>