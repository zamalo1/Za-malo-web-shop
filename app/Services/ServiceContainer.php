<?php


namespace App\Services;


use App\Entity\User;

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

    /**
     * @return User
     */
    public function getUser()
    {
        $session=$this->getSession();
        return new User($session->get('user_data'));
    }

}