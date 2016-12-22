<?php

$container['AppController'] = function ($container) {
    return new App\Controller\AppController($container);
};

$container['PointController'] = function ($container) {
    return new App\Controller\PointController($container);
};
