<?php

$version = '1.0';

$initialConfig = [
    "--title" => "Telenok CMS Docs",
    "--body-html" => [
        "<script type='text/javascript'>",
        "Docs.otherProducts = [",
            "{text: 'Russian', href: 'http://example.com/docs/2.0'},",
            "{text: 'Arabic', href: 'http://example.com/docs/1.0'}",
        "];",
        "</script>"
    ],
    "--seo" => true,
    "--warnings" => [],
    "--guides" => "",
    "--output" => "",
    "--" => []
];

$path = [
    '/home/telenoklocal/site/vendor/telenok/core/src/Telenok/Core',
    '/home/telenoklocal/site/vendor/telenok/news/src/Telenok/News',
    '/home/telenoklocal/site/vendor/telenok/shop/src/Telenok/Shop',
];

$output = '/home/telenoklocal/site/public/documentation/jsduck';
$guide = '/home/telenoklocal/site/jsduck-doc/new';
$tmp = '/home/telenoklocal/site/jsduck-doc/tmp.file';

$language = ['ru'/*, 'en', 'fr', 'de', 'ch', 'es', 'ar'*/];

$fileList = [];

foreach ($path as $v)
{
    $directory = new \RecursiveDirectoryIterator($v);
    $iterator = new \RecursiveIteratorIterator($directory);
    $regex = new \RegexIterator($iterator, '/^.+\.php$/i', \RecursiveRegexIterator::GET_MATCH);

    foreach ($regex as $f)
    {
        $fileList[] = $f[0];
    }
}

$initialConfig['--'] = $fileList;

foreach($language as $l)
{
    $initialConfig['--output'] = $output . '/' . $l;
    $initialConfig['--guides'] = $guide . '/' . $l . '/guides.json';

    file_put_contents($tmp, json_encode($initialConfig));
    
    exec('jsduck --config ' . $tmp);
}

