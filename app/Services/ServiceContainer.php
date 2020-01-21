<?php


namespace App\Services;


class ServiceContainer
{

    private $configuration;

    public function __construct($configuration)
    {
        $this->configuration=$configuration;
    }

   public function getEngine()
   {
       return new Engine($this->configuration);
   }

    /**
     * @return Session
     */
    public function getSession()
    {
        return new Session();
    }

}