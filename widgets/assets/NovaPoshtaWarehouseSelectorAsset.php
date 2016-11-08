<?php

namespace bl\cms\novaposhta\widgets\assets;

use yii\web\AssetBundle;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class NovaPoshtaWarehouseSelectorAsset extends AssetBundle
{

    public $sourcePath = '@vendor/black-lamp/blcms-nova-poshta/widgets/assets/src';

    public $css = [
    ];
    public $js = [
        'js/warehouse-selector.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
