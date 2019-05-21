<?php
return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    //'class' => 'app\components\LangUrlManager',
    'rules' => [
        '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/<_a>',

        '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>/<parms:[\w\-]+>' => '<_m>/<_c>/<_a>',
        '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
        '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
        '<_m:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>/<parms:[\w\-]+>' => '<_m>/default/<_a>',
        '<_m:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/default/<_a>',
        '<_m:[\w\-]+>/<id:\d+>' => '<_m>/default/view',
        '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
        '<_m:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/default/<_a>',

        '' => 'main/default/index',
    ],
];