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
    "--css" => [],
    "--seo" => true,
    "--external" => ["Illuminate.*"],
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

$tmpDir = '/home/telenoklocal/site/jsduck-doc/tmp/';

$language = ['ru'/*, 'en', 'fr', 'de', 'ch', 'es', 'ar'*/];

$fileList = [];

$uniqueId = md5(uniqid());

foreach ($path as $v)
{
    $directory = new \RecursiveDirectoryIterator($v);
    $iterator = new \RecursiveIteratorIterator($directory);
    $regex = new \RegexIterator($iterator, '/^.+\.php$/i', \RecursiveRegexIterator::GET_MATCH);

    foreach ($regex as $f)
    {
        $fp = str_replace('/home/telenoklocal/site/vendor/', $tmpDir, $f[0]);

        @mkdir(pathinfo($fp, PATHINFO_DIRNAME), 0777, true);

        copy($f[0], $fp);

        $content = file($fp);

        $ll = [];

        foreach($content as $line)
        {
            if (!preg_match('/^[\t\r ]*(\/\*|\*)/', $line))
            {
                $line = '//' . $uniqueId . $line;
            }

            $ll[] = $line;
        }

        file_put_contents($fp, implode("\n", $ll));

        $fileList[] = $fp;
    }
}

$initialConfig['--'] = $fileList;

foreach($language as $l)
{
    $initialConfig['--output'] = $output . '/' . $l;
    $initialConfig['--guides'] = $guide . '/' . $l . '/guides.json';

    file_put_contents($tmp, json_encode($initialConfig));
    
    exec('jsduck --config ' . $tmp);
    
    foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($output . '/' . $l . '/source')) as $filename)
    {
        if ($filename->isDir()) continue;

        file_put_contents($filename->getPathname(), str_replace('//' . $uniqueId, '', file_get_contents($filename->getPathname())));
    }
}