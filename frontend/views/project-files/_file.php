
<?php

use yii\helpers\Html;
use yii\helpers\Url;

$thumb = ($model->file and $model->file->type!='pdf') ? Html::img('/images/projects/'.$model->project->year.'/'.$model->project_id.'/'.$model->file->name, ['style'=>'max-height:30px;']) : '<i class="fa fa-file-pdf-o fa-3x gray-color"></i>';
?>

    <li><a href="/project-files/update?id=<?= $model->id ?>">
        <div class="header-context cont">
            <div class="avatar">
                <?= $thumb ?>
            </div>
            <div class="title" style="float:none; margin-left: 32px; ">
                <div class="head lower"><?= Html::a($model->document, Url::to(['/project-files/update', 'id'=>$model->id]), ['class' => '']) ?></div>
                <div class="subhead"><?= $model->name ?></div>
            </div>
        </div>
    </a></li>
            