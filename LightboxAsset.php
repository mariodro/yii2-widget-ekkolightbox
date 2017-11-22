<?php

namespace mdq\ekkolightbox; 

use yii\web\AssetBundle; 
class LightboxAsset extends AssetBundle 
{ 
    public $sourcePath = '@bower/ekko-lightbox/dist';
    public $css = [ 'ekko-lightbox.css', ]; 
    public $js = [ 'ekko-lightbox.min.js', ];
    
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}