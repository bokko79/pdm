<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="main-switch-menu" style="">
    <ul>
        <li class="dashboard"><i class="fa fa-file-o fa-2x"></i></li>
        <li class="<?= $this->params['page_title']=='Projekat' ? 'active' : null ?>"><a href="/projects/update?id=<?= $model->id ?>"><i class="fa fa-file fa-2x"></i><div style="font-size:9px;">Opšte</div></a></li>
        <li class="<?= $this->params['page_title']=='Sveske' ? 'active' : null ?>"><a href="/project-volumes/index?ProjectVolumes[project_id]=<?= $model->id ?>"><i class="fa fa-book fa-2x"></i><div style="font-size:9px;">Sveske</div></a></li>
        <li class="<?= $this->params['page_title']=='Lokacija' ? 'active' : null ?>"><a href="/project-lot/view?id=<?= $model->id ?>"><i class="fa fa-map-marker fa-2x"></i><div style="font-size:9px;">Lokacija</div></a></li>
        <li class="<?= $this->params['page_title']=='Objekat' ? 'active' : null ?>"><a href="/project-building/view?id=<?= (($model->projectBuilding) ? $model->projectBuilding->id : $model->projectExBuilding->id) ?>"><i class="fa fa-home fa-2x"></i><div style="font-size:9px;">Objekat</div></a></li>
        <?php if($model->work=='adaptacija'): ?>
        <li class="<?= $this->params['page_title']=='Jedinica' ? 'active' : null ?>"><i class="fa fa-bed fa-2x"></i><div style="font-size:9px;">Jedinica</div></a></li>
        <?php endif; ?>
        <li class="<?= $this->params['page_title']=='Predmer' ? 'active' : null ?>"><a href="/project-qs/index?ProjectQs[project_id]=<?= $model->id ?>"><i class="fa fa-calculator fa-2x"></i><div style="font-size:9px;">Predmer</div></a></li>

    </ul>
</div>