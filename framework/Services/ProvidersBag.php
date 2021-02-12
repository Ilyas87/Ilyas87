<?php


namespace Framework\Services;


use Framework\Providers\Provider;

class ProvidersBag extends Service {
    /** @var Provider[]|array */
    protected $providers = [];

    function register(string $provider){
        if (isset($providers[$provider]))
            throw new \Exception("Provider [$provider] already registered.");

        if (!is_a($provider, Provider::class, true))
            throw new \Exception("Provider is not instance of " . Provider::class);

        $this->providers[$provider] = new $provider($this->app);
        $this->providers[$provider]->register();
    }

    function boot() {
        foreach ($this->providers as $provider)
            $provider->boot();
    }

    function get(string $provider): Provider {
        if (!isset($this->providers[$provider]))
            throw new \Exception("Provider [$provider] does not registered.");
        return $this->providers[$provider];
    }
}