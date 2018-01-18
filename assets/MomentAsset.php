<?php
namespace app\assets;

use yii\web\AssetBundle;

class MomentAsset extends AssetBundle
{
    public $sourcePath = '@npm/moment/min';
    public $js = [
        'moment.min.js',
    ];
}
