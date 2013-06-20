<?php

use Silex\Application;

class App extends Application
{
    public function __construct(array $values = array())
    {
        parent::__construct($values);
        $this->register(new Config);
    }

}