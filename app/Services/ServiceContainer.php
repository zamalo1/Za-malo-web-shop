<?php


namespace App\Services;


class ServiceContainer
{

    private $configuration;

    public function __construct($configuration)
    {
        $this->configuration=$configuration;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return new Session();
    }

}