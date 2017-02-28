<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>0.7. Podaci o objektu i lokaciji</small></p>
	<h3 class="uppercase bold">Opšti podaci o objektu i lokaciji</h3>
	<table class="other smallpadd" style="border: 1px solid #777;">
		<tr>
			<td class="shorttitler"><small>tip objekta</small></td>
			<td class="content">
				
			</td>
		</tr>
		<tr>
			<td class=""><small>vrsta radova</small></td>
			<td class="content">
				<?= $model->projectTypeOfWorks ?>
			</td>
		</tr>	
		<tr>
			<td class=""><small>kategorija objekta</small></td>
			<td class="content">
				
			</td>
		</tr>
		<tr>
			<td class=""><small>klasifikacija pojedinih delova objekta</small></td>
			<td class="container">
				<table class="clear">
					<tr>
						<td class="titler" style="border-bottom: 1px dotted #777; border-right: 1px dotted #777;"><small>učešće u ukupnoj površini objekta (%)</small></td>
						<td style="border-bottom: 1px dotted #777;"><small>klasifikaciona oznaka</small></td>
					</tr>
					<?php // foreach loop kroz sve delove objekta  ?>
					<tr>
						<td class="titler" style="border-bottom: 1px dotted #777; border-right: 1px dotted #777;">100</td>
						<td style="border-bottom: 1px dotted #777;"><?= $model->building->class. ' - '.$model->building->name ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class=""><small>naziv prostornog, odnosno urbanističkog plana</small></td>
			<td class="content">
				
			</td>
		</tr>
		<tr>
			<td class=""><small>mesto</small></td>
			<td class="content">
				
			</td>
		</tr>
		<tr>
			<td class=""><small>broj katastarske parcele/spisak katastarskih parcela i katastarska opština</small></td>
			<td class="content">
				
			</td>
		</tr>
		<tr>
			<td class=""><small>broj katastarske parcele/spisak katastarskih parcela i katastarska opština preko kojih prelaze priključci za infrastrukturu</small></td>
			<td class="content">
				
			</td>
		</tr>
		<tr>
			<td class=""><small>broj katastarske parcele/spisak katastarskih parcela i katastarska opština na kojoj se
nalazi priključak na javnu saobraćajnicu</small></td>
			<td class="content">
				
			</td>
		</tr>		
	</table>

	<h4 class="uppercase bold">Priključci na infrastrukturu</h4>
	<table class="other smallpadd" style="border: 1px solid #777;">
		<tr>
			<td class="shorttitler"><small>priključak na toplovodnu instalaciju</small></td>
			<td class="content">
				
			</td>
		</tr>
		<tr>
			<td class=""><small>priključak na elektro-energetsku mrežu</small></td>
			<td class="content">

			</td>
		</tr>	
	</table>

	<h4 class="uppercase bold">Lokacijski uslovi</h4>
	<table class="other smallpadd" style="border: 1px solid #777;">
		<tr>
			<td class="shorttitler"><small>Lokacijski uslovi</small></td>
			<td class="content">
				
			</td>
			<td class="content">
				Br.: <br>
				Datum:
			</td>
		</tr>
	</table>

	<h4 class="uppercase bold">Saglasnosti</h4>
	<table class="other smallpadd" style="border: 1px solid #777;">
		<tr>
			<td class="shorttitler"><small>Obavezne saglasnosti</small></td>
			<td class="content">
				
			</td>
			<td class="content">
				Br.: <br>
				Datum:
			</td>
		</tr>
	</table>

	<div class="pagebreaker"></div>
	<h3 class="uppercase bold">Osnovni podaci o objektu i lokaciji</h3>