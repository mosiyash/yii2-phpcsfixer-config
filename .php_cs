<?php

use mosiyash\phpcsfixer\yii2\YiiSoftConfig;
use PhpCsFixer\Finder;

require __DIR__.'/vendor/autoload.php';

if (!class_exists(YiiSoftConfig::class, true)) {
    // @todo change error message
    fwrite(STDERR, "Your php-cs-version is outdated: please upgrade it.\n");
    die(16);
}

$finder = new Finder();
$finder->exclude(__DIR__.'/vendor');
foreach (['api', 'backend', 'common', 'console', 'frontend'] as $dirName) {
    $finder->in(__DIR__.'/'.$dirName);
    foreach (['runtime', 'web/assets'] as $subDirName) {
        $finder->exclude(__DIR__.'/'.$dirName.'/'.$subDirName);
    }
}

return YiiSoftConfig::create()
    ->setCacheFile(__DIR__ . '/console/runtime/php_cs.cache')
    ->mergeRules([
        'braces' => [
            'allow_single_line_closure' => true,
        ],
    ])
    ->setFinder($finder);
