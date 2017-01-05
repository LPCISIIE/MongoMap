<?php

$container = $app->getContainer();

$container['foundHandler'] = function() {
    return new \Slim\Handlers\Strategies\RequestResponseArgs();
};

$container['mongo'] = function ($container) {
    return new \App\Service\MongoDB(
        $container['settings']['mongo']['uri'],
        $container['settings']['mongo']['database']
    );
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

$container['validator'] = function () {
    return new \Awurth\Slim\Validation\Validator();
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(
        $container['settings']['view']['template_path'],
        $container['settings']['view']['twig']
    );

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));
    $view->addExtension(new \Twig_Extension_Debug());
    $view->addExtension(new \App\TwigExtension\Asset($container['request']));
    $view->addExtension(new \Awurth\Slim\Validation\ValidatorExtension($container['validator']));

    $view->getEnvironment()->addGlobal('flash', $container['flash']);
    $view->getEnvironment()->addGlobal('mongo', $container['mongo']);

    return $view;
};

foreach ($container['settings']['routes']['files'] as $file) {
    require $container['settings']['routes']['dir'] . '/' . $file . '.php';
}
