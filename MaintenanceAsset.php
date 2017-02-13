<?php
namespace sankam\maintenance;

use yii\web\AssetBundle;

/**
 * Class MaintenanceAsset
 * @package sankam\maintenance
 */
class MaintenanceAsset extends AssetBundle
{
    public $sourcePath = '@sankam/maintenance/assets';

    public $css = [
        'css/maintenance.css'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
