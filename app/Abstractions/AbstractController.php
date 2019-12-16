<?php


namespace App\Abstractions;


use App\Services\ServiceContainer;

abstract class AbstractController
{
    protected $container;

    public function __construct(ServiceContainer $container)
    {
        $this->container=$container;
    }

    protected function isLogged()
    {
        $session=$this->container->getSession();
        return $session->isUserLogged();
    }
}