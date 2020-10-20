<?php

namespace App\Providers;

use Elastica\Client;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\ElasticaHandler;
use Monolog\Logger;

class ElasticLogProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $elasticaClient = new Client(array(
            'host' => '172.19.0.1',
            'port' => 9200
        ));

        $handler = new ElasticaHandler($elasticaClient);
        $monolog = new Logger('elasticsearch');
        $monolog->pushHandler($handler);

        $this->app->singleton(Logger::class, function () use ($monolog) {
            return $monolog;
        });
    }
}