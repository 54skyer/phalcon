<?php

$router = $di->getRouter();

# 从uri中解析出module
$requestUri = $_SERVER['REQUEST_URI'];
$requestUri = trim($requestUri, '/');
$requestUri = explode('/', $requestUri);
// die(json_encode($application->getModules()));
// die(json_encode($requestUri));
$uriModule = isset($requestUri[0]) ? strtolower($requestUri[0]) : '';

# 判断符合就按需加载，否则加载默认路由
$modulesMap = [];
foreach ($application->getModules() as $key => $module) {
    $modulesMap[$key] = true;
}

if(isset($modulesMap[$uriModule])){
    include APP_PATH . '/config/routes_'.$uriModule.'.php';
    return;
}
# 响应404；
foreach ($application->getModules() as $key => $module) {
    $namespace = preg_replace('/Module$/', 'Controllers', $module['className']);
    // die($namespace);
    $router->add('/'.$key.'/:params', [
        'namespace' => $namespace,
        'module' => $key,
        'controller' => 'index',
        'action' => 'index',
        'params' => 1
    ])->setName($key);

    $router->add('/'.$key.'/:controller/:params', [
        'namespace' => $namespace,
        'module' => $key,
        'controller' => 1,
        'action' => 'index',
        'params' => 2
    ]);

    $router->add('/'.$key.'/:controller/:action/:params', [
        'namespace' => $namespace,
        'module' => $key,
        'controller' => 1,
        'action' => 2,
        'params' => 3
    ]);
}
