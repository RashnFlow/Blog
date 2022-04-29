<?php


namespace app\assets;

/**
 * Public application asset bundle.
 */
class PublicAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "/public/css/bootstrap.min.css",
        "/public/css/font-awesome.min.css",
        "/public/css/animate.min.css",
        "/public/css/owl.carousel.css",
        "/public/css/owl.theme.css",
        "/public/css/owl.transitions.css",
        "/public/css/style.css",
        "/public/css/responsive.css"
    ];
    public $js = [
        "/public/js/jquery-1.11.3.min.js",
        "/public/js/bootstrap.min.js",
        "/public/js/owl.carousel.min.js",
        "/public/js/jquery.stickit.min.js",
        "/public/js/menu.js",
        "/public/js/scripts.js"
    ];
    public $depends = [
    ];
}