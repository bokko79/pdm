
<?php

use yii\helpers\Html;
use yii\helpers\Url;

$client = $model->client;
?>

<li>
    <a href="/project-clients/update?id=<?= $model->id ?>">
        <div class="secondary-context normal no-padding">
            <div class="head lower">
                <div class="subaction">
                    <?= Html::a('<i class="fa fa-user-circle fa-lg"></i>', ['/clients/view', 'id'=>$client->id], ['class' => 'btn btn-link', 'style' => 'color:#999', 'target'=>'_blank']) ?>
                </div>
                <?= Html::a($client->name, Url::to(['/project-clients/update', 'id'=>$model->id]), ['class' => '']) ?>
            </div>
            <div class="subhead"><?= $client->location->fullAddress ?></div>
        </div>    
    </a>
</li>
        