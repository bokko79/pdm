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
p{padding: 0; margin: 0 0 15px 0; line-height: 20px; text-indent: 30px;}
h3 {font-weight: 900; font-size: 14pt;}
h3.sub {font-style: italic; text-transform: uppercase; font-size: 13pt; margin:10px 0;}
h4.nopadd {padding: 0; margin: 0; line-height: 24px;}
h5.nopadd , h5.nopadd p {padding: 0; margin: 0; line-height: 20px;}
table {vertical-align: top;}

table, th, td {
    /*border: 1px solid #777;*/
}
table {width: 100%; border: 1px solid #000}
table.other th, table.other td {
    border: 1px dotted #777;
}
table.homepage td {padding: 10px 20px; }
table.other td {padding: 10px; }
table.bottom {margin-bottom:50px; }
table.nopadd td {padding: 0px 10px; }
table.smallpadd td {padding: 2px 10px; }
table.clear {border:none;}
td.titler {width: 40%;}
td.shorttitler {width: 30%;}
td.container {padding:0; margin:0;}
td.container table, td.container table td {padding:0; margin:0; border:none;}
.pagebreaker {page-break-after: always;}
	</style>
}
</head>
<body>
	<?php
		// 0.1. Naslovna strana glavne sveske
		// Obavezno u svim slučajevima
	 ?>
			<?php echo $this->render('../insets/0_1_naslovna', ['model'=>$model]) ?>

	<div class="pagebreaker"></div>

	<?php 
		// 0.2. Sadržaj glavne sveske
		// Obavezno u svim slučajevima
	 ?>
			<?php echo $this->render('../insets/0_2_sadrzaj', ['model'=>$model]) ?>

	<div class="pagebreaker"></div>

	<?php
		// 0.3. Odluka o određivanju glavnog projektanta
		// Samo u IDP, PGD, PZI, PIO
		if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'): ?>	
			<?= $this->render('../insets/0_3_odluka', ['model'=>$model]) ?>

	<div class="pagebreaker"></div>

	<?php 
		// 0.4. Izjava glavnog projektanta
		// Samo u IDP, PGD, PZI, PIO ?>
			<?= $this->render('../insets/0_4_izjava', ['model'=>$model]) ?>

	<div class="pagebreaker"></div>
		<?php endif; ?>

	<?php // 0.5. Sadržaj tehničke dokumentacije ?>
			<?= $this->render('../insets/0_5_sadrzaj_tehdok', ['model'=>$model]) ?>

	<div class="pagebreaker"></div>

	<?php  // 0.6. Podaci o projektantima ?>
			<?= $this->render('../insets/0_6_podaci', ['model'=>$model]) ?>

	<div class="pagebreaker"></div>

	<?php // 0.7. Opšti podaci o objektu ?>
			<?= $this->render('../insets/0_7_opsti', ['model'=>$model, 'volume'=>$volume]) ?>

	

	<?php
		// 0.8. Sažeti tehnički opis 
		// Samo u IDP, PGD i PIO 
		if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pio'): ?>

		<!--<div class="pagebreaker"></div>-->

			<?= $this->render('../insets/0_8_tehopis', ['model'=>$model, 'volume'=>$volume]) ?>

		
		<?php endif; ?>

	<?php
		// 0.9. Izjave ovlašćenih lica o merama za ispunjenje osnovnih zahteva za objekat 
		// Samo u IDP i PGD 
		if($model->phase=='idp' or $model->phase=='pgd'): ?>

		<div class="pagebreaker"></div>
			<?= $this->render('../insets/0_9_ovl_lica', ['model'=>$model]) ?>	
		<?php endif; ?>

	<?php 
		// 0.10. Kopije dobijenih saglasnosti 
		// Samo u PGD i PIO 
		if($model->phase=='pio' or $model->phase=='pgd'): ?>

		<div class="pagebreaker"></div>
			<?= $this->render('../insets/0_10_saglasnosti', ['model'=>$model]) ?>
		<?php endif; ?>

	<?php /*
		// 0.11. Izjava investitora, vršioca stručnog nadzora i izvođača radova
		// Samo u PIO
		if($model->phase=='pio'): ?>
		<div class="pagebreaker"></div>
			<?= $this->render('../insets/0_11_investitor', ['model'=>$model]) ?>
		<?php endif;  ?>

		<?= $this->render('../insets/povrsine', ['model'=>$model, 'volume'=>$volume])*/ ?>

</body>
</html>
