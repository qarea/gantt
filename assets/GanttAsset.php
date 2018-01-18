<?php
namespace app\assets;

use yii\web\AssetBundle;

class GanttAsset extends AssetBundle
{
    public $sourcePath = '@npm/frappe-gantt/dist';
    public $js = [
        'frappe-gantt.min.js',
    ];
    public $depends = [
        'app\assets\MomentAsset',
        'app\assets\SnapSvgAsset'
    ];
}
