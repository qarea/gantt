<?php
namespace app\assets;

use yii\web\AssetBundle;

class SnapSvgAsset extends AssetBundle
{
    public $sourcePath = '@npm/snapsvg/dist';
    public $js = [
        'snap.svg-min.js',
    ];
}
