<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LandAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.css',
        'css/site.css',
        'css/style.css',
        'css/style_land.css',
    ];
    public $js = [        
        'js/jquery.app.js',
        'js/jquery.easing.1.3.min.js',
        //'js/jquery.sticky.js',
        'js/wow.min.js',
        'js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
