<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-phase" content="text/html; charset=utf-8" />
<head>
	<!--<link rel="stylesheet" href="@frontend/web/css/style_pdf.css">-->
	<style phase="text/css">
		html, body {font-family: 'freesans', sans-serif;}
.center {text-align: center}
.right {text-align: right}
.bold {font-weight: bold;}
.uppercase {text-transform: uppercase;}
.times {font-family: 'freeserif', serif; font-weight: bold;}
h3 {font-weight: bold; font-size: 14pt;}
table {vertical-align: top;}
.hint {font-size: 8pt;}

table, th, td {
    border: 1px solid #777;
    border-collapse: collapse;
    padding: 10px;
}
table {width: 100%; border: 1px solid #000}
table.other th, table.other td {
    border: 1px dotted #777;
}
table.homepage td {padding: 10px 20px; border:none;}
table.other td {padding: 10px; }
table.bottom {margin-bottom:50px; }
table.nopadd td {padding: 0px 10px; }
table.smallpadd td {padding: 2px 10px; }
table.clear, table.clear th, table.clear td {border:none;}
td.titler {width: 40%;}
td.shorttitler {width: 30%;}
td.container {padding:0; margin:0;}
td.container table, td.container table td {padding:0; margin:0; border:none;}
table.clear td.storeys {border-bottom: 1px dotted #777 !important; border-right: 1px dotted #777 !important;}
table.clear td.storeys-bottom {border-bottom: 1px dotted #777 !important;}
table.clear td.storeys-right {border-right: 1px dotted #777 !important;}
.pagebreaker {page-break-after: always;}
	</style>
}
</head>
<body>
	<?php 
		// 1.1. Naslovna strana projekta
		// Obavezno u svim slučajevima
	 ?>
			<?= $this->render('../insets/1_1_naslovna', ['model'=>$model, 'volume'=>$volume]) ?>

	<div class="pagebreaker"></div>

	<?php if($model->phase=='pgd'):
		// 1.1. Naslovna strana projekta
		// Obavezno u svim slučajevima
	 ?>
			<?= $this->render('../insets/1_1_1_prihvatase', ['model'=>$model, 'volume'=>$volume]) ?>

	<div class="pagebreaker"></div>
	<?php endif; ?>
	<?php 
		// 1.2. Sadržaj projekta
		// Obavezno u svim slučajevima
	 ?>
			<?php echo $this->render('../insets/1_2_sadrzaj', ['model'=>$model, 'volume'=>$volume]) ?>

	<div class="pagebreaker"></div>

	<?php
		// 1.3. Odluka o određivanju odgovornog projektanta
		// Samo u IDP, PGD, PZI, PIO
		if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'): ?>	
			<?= $this->render('../insets/1_3_resenje', ['model'=>$model, 'volume'=>$volume]) ?>
		<?php endif; ?>

	<?php
		// 1.4. Izjava odgovornog projektanta
		// Samo u IDP, PGD, PZI, PIO
		if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'): ?>	
			<?= $this->render('../insets/1_4_izjava', ['model'=>$model, 'volume'=>$volume]) ?>
		<?php endif; ?>

	<?php
		// 1.5. Tekstualna dokumentacija - naslovna ?>
			<?= $this->render('../insets/1_5_tekstualna_naslovna', ['model'=>$model, 'volume'=>$volume]) ?>

	<?php
		// 1.6. Numerička dokumentacija - naslovna ?>
			<?= $this->render('../insets/1_6_numericka_naslovna', ['model'=>$model, 'volume'=>$volume]) ?>

	<?php /*
		// 1.6.1 Obračun površina ?>
			<?= $this->render('../insets/povrsine', ['model'=>$model, 'volume'=>$volume]) */ ?>

	<?php /*
		// 1.6.2 Predmer i predračun radova ?>
			<?= $this->render('../qs/quantities', ['model'=>$model, 'volume'=>$volume]) */ ?>

	<?php /*
		// 1.6.3 Šeme stolarije i bravarije, samo u projektu arhitekture ?>
			<?= $this->render('../schemes/scheme', ['model'=>$model, 'volume'=>$volume]) */ ?>

	<?php
		// 1.7. Grafička dokumentacija - naslovna ?>
			<?= $this->render('../insets/1_7_graficka_naslovna', ['model'=>$model, 'volume'=>$volume]) ?>

	

		

</body>
</html>
