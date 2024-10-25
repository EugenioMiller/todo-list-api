<?php
require_once 'libs/router.php';
require_once 'app/controllers/task.api.controller.php';
    
// crea el router
$router = new Router();

// define la tabla de ruteo
#                 endpoint         verbo        controller                     método
$router->addRoute('tareas',        'GET',       'TaskApiController',         'getAll');
$router->addRoute('tareas',        'POST',      'TaskApiController',         'create');
$router->addRoute('tarea/:id',     'GET',       'TaskApiController',         'get');
$router->addRoute('tarea/:id',     'DELETE',    'TaskApiController',         'delete');
$router->addRoute('tarea/:id',     'PUT',       'TaskApiController',         'update');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
