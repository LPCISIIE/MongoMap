<?php

$app->get('/', 'AppController:home')->setName('home');

$app->map(['GET', 'POST'], '/points/add', 'PointController:add')->setName('add_point');
