<?php
namespace mdm\admin;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@npm/@fortawesome/fontawesome-free';
    public $css = [
        'css/all.min.css',
    ];
}

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@npm/admin-lte/dist';
    public $css = [
        'css/adminlte.min.css',
    ];
    public $js = [
        'js/adminlte.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'mdm\admin\FontAwesomeAsset',
    ];
}