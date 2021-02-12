<?php


namespace Framework\Services;


use Framework\Application;

abstract class Service {
    protected $app;

    public function __construct(Application $app) {
        $this->app = $app;
    }
}