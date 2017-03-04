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
table.homepage td {padding: 15px 20px; }
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
		// 0.1. Naslovna strana glavne sveske
		// Obavezno u svim slučajevima
	 ?>
			<?php /* echo $this->render('../insets/0_1_naslovna', ['model'=>$model]) ?>

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
			<?= $this->render('../insets/0_3_odluka', ['model'=>$model]) */ ?>




		<?= $this->render('../insets/scheme', ['model'=>$model, 'volume'=>$volume]) ?>

</body>
</html>
