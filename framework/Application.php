<?php


namespace Framework;


use Framework\Providers\Provider;
use Framework\Services\Config;
use Framework\Services\ProvidersBag;
use Framework\Services\Service;

class Application
{
    protected static $instance;
    protected $root;
    protected $services;
    /** @var ProvidersBag */
    protected $providers;

    protected function __construct() {
        $this->services = [];
        $this->providers = $this->get(ProvidersBag::class);
    }

    static function instance(): self {
        if (!static::$instance instanceof static)
            static::$instance = new static();

        return static::$instance;
    }

    function run(string $root) {
        $this->root = realpath($root);
        $providers = config('app.providers', []);
        $this->registerProviders($providers);

        $this->providers->boot();
        return true;
    }

    function rootPath() {
        return $this->root;
    }

    static function start(string $root) {
        return static::instance()->run($root);
    }

    function get(string $class, array $arguments = []) {
        if (is_a($class, Service::class, true))
            return $this->resolveService($class);

        if (is_a($class, Provider::class, true))
            return $this->providers->get($class);

        return new $class(... $arguments);
    }

    protected function registerProviders(array $providers){
        foreach($providers as $provider){
            $this->providers->register($provider);
        }
    }

    protected function resolveService(string $class) {
        if (!isset($this->services[$class]))
            $this->services[$class] = new $class($this);

        return $this->services[$class];
    }
}