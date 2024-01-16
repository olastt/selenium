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
        try {
            $element = $wait->until(
                WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::xpath($xpath))
            );

            // Продолжайте выполнение кода только если элемент был найден
            $element->click();
        } catch (NoSuchElementException $e) {
            // Обработка ситуации, когда элемент не был найден
            throw new NoSuchElementException("Element not found for xpath: $xpath");
        }
    }


}