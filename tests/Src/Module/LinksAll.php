<?php

namespace Src\Module;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;

class LinksAll
{
    private $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function SeasonSummer()
    {
        $wait = new WebDriverWait($this->driver, 20);
        $wait->until(
            WebDriverExpectedCondition::urlContains('/catalog/tyres/new-is-1/season-is-summer/width-is-35/?filter=by-params')
        );
    }
}