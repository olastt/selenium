<?php

namespace Src\Module;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;

class Scroll
{
    protected $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

}