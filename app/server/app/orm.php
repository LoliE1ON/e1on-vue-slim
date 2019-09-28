<?php
declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

return function (ContainerInterface $containerBuilder) {

    $capsule = new Capsule;

    $capsule->addConnection($containerBuilder->get('db'));

    // This will Capsule instance available globally via static methods
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM
    $capsule->bootEloquent();
};