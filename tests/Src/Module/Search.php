<?php

namespace Src\Module;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;

class Search
{
    protected $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function clickByXpath($xpath)
    {
        $wait = new WebDriverWait($this->driver, 10); // 10 секунд ожидания
        $element = $wait->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath($xpath))
        );

        if ($element) {
            $element->click();
        } else {
            // Обработка ситуации, когда элемент не был найден
            throw new NoSuchElementException("Element not found for xpath: $xpath");
        }
    }

}