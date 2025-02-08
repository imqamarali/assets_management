<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        /*'css/site.css',*/


        'http://fonts.googleapis.com',
        'http://fonts.gstatic.com',
        'http://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap',
        'vendors/simplebar/simplebar.min.css',
        'http://unicons.iconscout.com/release/v4.0.8/css/line.css',
        'asset/css/theme-rtl.min.css',
        'asset/css/theme.min.css',
        'asset/css/user-rtl.min.css',
        'asset/css/user.min.css',
        'vendors/leaflet/leaflet.css',
        'vendors/leaflet.markercluster/MarkerCluster.css',
        'vendors/leaflet.markercluster/MarkerCluster.Default.css',
    ];
    public $js = [
        'vendors/imagesloaded/imagesloaded.pkgd.min.js',
        'vendors/simplebar/simplebar.min.js',
        'asset/js/config.js',


    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
