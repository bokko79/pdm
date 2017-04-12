<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class GeoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.css',
        'css/site.css',
        'css/style.css',
        'css/style_box1.css',
    ];
    public $js = [
        'js/bootstrap-tabcollapse.js',
        'js/app.js',
        'js/jquery.geocomplete.js',
        'js/geocomplete.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
