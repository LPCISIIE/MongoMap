<?php

$container['AppController'] = function ($container) {
    return new App\Controller\AppController($container);
};

$container['AdminController'] = function ($container) {
    return new App\Controller\AdminController($container);
};

$container['CountryController'] = function ($container) {
    return new App\Controller\CountryController($container);
};

$container['PointController'] = function ($container) {
    return new App\Controller\PointController($container);
};
