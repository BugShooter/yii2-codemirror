<?php
namespace yiiBoy\CodeMirror;

use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $js = [
        'lib/codemirror.js',
        'mode/htmlmixed/htmlmixed.js',
        'mode/xml/xml.js',
        'mode/css/css.js',
        'mode/javascript/javascript.js',
        'mode/vbscript/vbscript.js',
        'mode/http/http.js',
    ];
    public $css = [
        'lib/codemirror.css'
    ];

    public function init()
    {
        $this->sourcePath = !YII_DEBUG?'@bower/codemirror':'@bower/codemirror';
    }
}
