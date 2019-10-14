<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Actions\Auth\Token;
use App\Application\Actions\World\Statistic;
use App\Application\Actions\Vrchat\ApiOnlinePlayers;
use \App\Application\Actions\Vrchat\World;

return function (App $app) {

    $container = $app->getContainer();

    $app->post('/auth/getToken', Token::class);
    $app->post('/world/statistic', Statistic::class);
    $app->post('/vrchat/world', World::class);

    // Cron
    $app->get('/vrchat/players', ApiOnlinePlayers::class);

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });
    
    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        
        return $response
                ->withHeader('Access-Control-Allow-Origin', $_ENV['SERVER_NAME_CLIENT'])
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

};
