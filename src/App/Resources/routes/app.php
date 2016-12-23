<?php

$app->get('/', 'AppController:home')->setName('home');

$app->map(['GET', 'POST'], '/points/add', 'PointController:add')->setName('add_point');

$app->group('/admin', function () {
    $this->get('', 'AdminController:home')->setName('admin');

    $this->group('/countries', function () {
        $this->get('', 'CountryController:get')->setName('get_countries');
        $this->map(['GET', 'POST'], '/add', 'CountryController:add')->setName('add_country');
        $this->map(['GET', 'POST'], '/{id}/edit', 'CountryController:edit')->setName('edit_country');
        $this->get('/{id}/delete', 'CountryController:delete')->setName('delete_country');
    });

    /*$this->group('/cities', function () {
        $this->get('', 'CityController:get')->setName('get_countries');
        $this->map(['GET', 'POST'], '/add', 'CityController:add')->setName('add_country');
        $this->map(['GET', 'POST'], '/{name}/edit', 'CityController:edit')->setName('edit_country');
        $this->get('/{name}/delete', 'CityController:delete')->setName('delete_country');
    });*/
});
