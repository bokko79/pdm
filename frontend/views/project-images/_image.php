
<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<li class="center" style="background: url('/images/projects/<?= $model->project->year ?>/<?= $model->project_id ?>/<?= $model->file->name ?>') top left/100% 100%; height:75px; padding:0;">
    <a href="/project-images/update?id=<?= $model->id ?>" style="height:75px; display:block;"></a>
</li>
