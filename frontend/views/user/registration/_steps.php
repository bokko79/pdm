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
?>
<div class="row" style="margin: 0 0 50px;">
    <div class="col-md-3 center">
        <p <?= (\Yii::$app->controller->id=='registration' and Yii::$app->controller->action->id=='register') ? 'style="font-weight:900; text-transform:uppercase;"' : 'class="hint"' ; ?>>1. Opšti podaci inženjera<p>
    </div>
    <div class="col-md-3 center">
        <p <?= (\Yii::$app->controller->id=='registration' and Yii::$app->controller->action->id=='register-licence') ? 'style="font-weight:900; text-transform:uppercase;"' : 'class="hint"' ; ?>>2. Licencni paket</p>
    </div>
    <div class="col-md-3 center">
        <p <?= (\Yii::$app->controller->id=='registration' and Yii::$app->controller->action->id=='register-signature') ? 'style="font-weight:900; text-transform:uppercase;"' : 'class="hint"' ; ?>>3. Skenirani potpis</p>
    </div>
    <div class="col-md-3 center">
        <p <?= (\Yii::$app->controller->id=='registration' and Yii::$app->controller->action->id=='register-practice') ? 'style="font-weight:900; text-transform:uppercase;"' : 'class="hint"' ; ?>>4. Podaci o preduzeću</p>
    </div>
</div>