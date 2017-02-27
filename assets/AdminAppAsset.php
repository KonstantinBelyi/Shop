<?php


namespace app\assets;

use yii\web\AssetBundle;

class AdminAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css',
    ];
    public $js = [
        //'js/jquery.js',
        //'js/bootstrap.min.js',
        'js/jquery.scrollUp.min.js',
        'js/price-range.js',
        'js/jquery.prettyPhoto.js',
        'js/jquery.cookie.js',
        'js/jquery.accordion.min.js',
        'js/jquery.hoverIntent.minified.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}