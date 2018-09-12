<?php

namespace MonProjet\Infrastructure;

abstract class Form
{
    private $errorMessage;


    abstract public function build();


    public function __construct()
    {
        $this->errorMessage = null;
    }


    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }
}