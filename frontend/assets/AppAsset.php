<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.css',
        'css/site.css',
        'css/style.css',
        'css/style_box1.css',
        'css/header.css',
        'css/style-responsive.css',
    ];
    public $js = [        
        'js/bootstrap-tabcollapse.js',
        'js/app.js',
        //'js/header.js',
        //'js/masonry.pkgd.min.js',
        //'js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
