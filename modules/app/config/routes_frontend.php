<?php

$router = $di->getRouter();

$module = 'frontend';
// die(json_encode($application->getModules()));
$namespace = preg_replace('/Module$/', 'Controllers', $application->getModules()[$module]['className']);
// die($namespace);

$router->add('/'.$module.'/:params', [
    'namespace' => $namespace,
    'module' => $module,
    'controller' => 'user',
    'action' => 'search',
    // 'params' => 1
]);
