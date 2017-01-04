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

    $this->group('/cities', function () {
        $this->get('', 'CityController:get')->setName('get_cities');
        $this->map(['GET', 'POST'], '/add', 'CityController:add')->setName('add_city');
        $this->map(['GET', 'POST'], '/{id}/edit', 'CityController:edit')->setName('edit_city');
        $this->get('/{id}/delete', 'CityController:delete')->setName('delete_city');
    });

    $this->group('/categories', function () {
        $this->get('', 'CategoryController:get')->setName('get_categories');
        $this->map(['GET', 'POST'], '/add', 'CategoryController:add')->setName('add_category');
        $this->map(['GET', 'POST'], '/{id}/edit', 'CategoryController:edit')->setName('edit_category');
        $this->get('/{id}/delete', 'CategoryController:delete')->setName('delete_category');
    });
});
