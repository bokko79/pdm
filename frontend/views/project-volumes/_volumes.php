
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\widgets\ListView;

?>
<div class="card_container record-full grid-item no-margin no-padding no-shadow" id="client">
    <div class="primary-context gray normal">
        <div class="head">
            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/project-volumes/create', 'ProjectVolumesSearch[project_id]'=>$model->id]), ['class' => 'btn btn-link']) ?></div>
            Sveske projekta
        </div>
        <div class="subhead">Lista svezaka  projekta.

        </div>
    </div>
    <div class="secondary-context  no-padding">
        <ul class="index-menu no-padding">
        <?php /* if($projectVolumes = $model->projectVolumes){
            foreach($projectVolumes as $projectVolume){
                $volume = $projectVolume->volume; ?>
                <li><a href="/project-volumes/update?id=<?= $projectVolume->id ?>">
                    <div class="header-context cont">
                        <div class="avatar">
                            <i class="fa fa-file-pdf-o fa-3x gray-color"></i>       
                        </div>

                        <div class="title" style="float:none; margin-left: 32px; ">
                            <div class="head lower"><?= Html::a($volume->name, Url::to(['/project-volumes/update', 'id'=>$projectVolume->id]), ['class' => '']) ?></div>
                            <div class="subhead"><?= $projectVolume->engineer->name ?></div>
                        </div>
                    </div>
                </a>
                </li>
        <?php
            }
        } else {
            echo '<li>Nije uneta nijedna sveska projekta.</li>';
            } */ ?>
             <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_volume_short',
                'layout' => '{items}',
                'itemOptions' => ['tag'=>'li']
            ]); ?>
        </ul>
    </div>                
</div>