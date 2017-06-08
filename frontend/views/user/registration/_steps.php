<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
/*
?>
<div class="row" style="margin: 0 0 50px;">
    <div class="col-md-4 center">
        <p <?= (\Yii::$app->controller->id=='registration' and Yii::$app->controller->action->id=='register') ? 'style="font-weight:900; text-transform:uppercase; font-size:20px !important;"' : 'class="hint"' ; ?>>1. Opšti podaci inženjera<p>
    </div>
    <div class="col-md-4 center">
        <p <?= (\Yii::$app->controller->id=='registration' and Yii::$app->controller->action->id=='register-licence') ? 'style="font-weight:900; text-transform:uppercase;"' : 'class="hint"' ; ?>>2. Licencni paket</p>
    </div>
    <div class="col-md-4 center">
        <p <?= (\Yii::$app->controller->id=='registration' and Yii::$app->controller->action->id=='register-practice') ? 'style="font-weight:900; text-transform:uppercase;"' : 'class="hint"' ; ?>>3. Podaci o preduzeću</p>
    </div>
</div>
*/ ?>
<div class="container">        
        
    <div class="row bs-wizard" style="border-bottom:0;">
        
        <div class="col-xs-4 bs-wizard-step <?= (Yii::$app->controller->action->id=='register') ? 'active' : 'complete' ; ?>">
          <div class="text-center bs-wizard-stepnum">Korak 1</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">1. Opšti podaci inženjera</div>
        </div>
        
        <div class="col-xs-4 bs-wizard-step <?= (Yii::$app->controller->action->id=='register-licence') ? 'active' : ((Yii::$app->controller->action->id=='register') ? 'disabled' : 'complete') ; ?>"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Korak 2</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">2. Licencni paket</div>
        </div>
        
        <div class="col-xs-4 bs-wizard-step <?= (Yii::$app->controller->action->id=='register-practice') ? 'active' : 'disabled' ; ?>"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Korak 3</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">3. Podaci o preduzeću</div>
        </div>
    </div>     
</div>