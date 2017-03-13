<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Urbanistički parametri</h4>
<hr>

    <?= $form->field($model, 'green_area_reg', [
                'addon' => ['prepend' => ['content'=>'%']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Uneti vrednost predviđene površine zelenih površina date u važećem prostornom planu ili dato na osnovu rešenja o lokacijskim uslovima ili sl.') ?>
    <?= $form->field($model, 'green_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Isprojektovana površina zelenih površina.') ?>

    <?= $form->field($model, 'occupancy_reg', [
                'addon' => ['prepend' => ['content'=>'%']]])->input('number', ['max'=>100, 'min'=>0, 'step'=>0.01, 'style'=>'width:40%'])->hint('Zahtevana zauzetost parcele. <br>Zauzetost je odnos površina parcele pod objektom u odnosu na površinu same parcele, date u procentima.') ?>

    <?= $form->field($model, 'built_index_reg')->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Zahtevani indeks zauzetosti za datu parelu, na osnovu važećeg prostornog plana. <br>Indeks zauzetosi je odnos ukupne BRGP objekta u odnosu na površinu parcele.') ?>    

    <?= $form->field($model, 'parking_spaces')->input('number', ['min'=>0, 'style'=>'width:40%'])->hint('Ukupan broj isprojektovanih parking mesta na parceli.') ?>

    <?= $form->field($model, 'parking_disabled')->input('number', ['min'=>0, 'style'=>'width:40%'])->hint('Ukupan broj isprojektovanih parking mesta na parceli predviđenih za osobe sa invaliditetom.') ?>