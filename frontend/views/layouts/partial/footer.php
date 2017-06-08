<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<footer id="footer" style="padding:30px 0">

	<div class="contact" style="margin:0;">
	
		<?= Html::a('<i class="fa fa-facebook fa-lg"></i>', 'https://www.facebook.com/masterplan', ['class'=>'btn btn-link', 'target'=>'_blank']) ?>
        <?= Html::a('<i class="fa fa-twitter fa-lg"></i>', 'https://twitter.com/servicemappSRB', ['class'=>'btn btn-link', 'style'=>'padding: 0 10px;', 'target'=>'_blank']) ?>
        <?= Html::a('<i class="fa fa-google-plus fa-lg"></i>', 'https://plus.google.com/111378181200148646566/', ['class'=>'btn btn-link', 'target'=>'_blank'])  ?>					

	</div>

	<ul class="">
		<li><?= Html::a('Projekti', ['/projects'], ['class'=>'', 'target'=>'_blank']) ?></li>
		<li><?= Html::a('Projektanti', ['/engineers'], ['class'=>'', 'target'=>'_blank']) /* ?></li>
		<li><?= Html::a('Firme', ['/practices'], ['class'=>'', 'target'=>'_blank'])  ?></li>
		<li><?= Html::a('Info', ['/posts'], ['class'=>'', 'target'=>'_blank'])*/ ?></li>
		<li><?= Html::a('Regulativa', ['/regulations'], ['class'=>'', 'target'=>'_blank']) ?></li>
	</ul>
	<?= Html::img('/images/logo3-white.png', ['alt'=>'Masterplan Logo', 'width'=>200, 'style'=>'margin:10px 0 5px']) ?>
	<br>
	Copyright &copy; <?php echo date('Y'); ?> by Masterplan ARC. 
	<?php echo Yii::t('app', 'Sva prava zadržana.'); ?>
	
</footer><!-- footer -->