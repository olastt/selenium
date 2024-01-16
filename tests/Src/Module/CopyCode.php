<?php

namespace Src\Module;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;
use PHPUnit\Framework\Assert;


class CopyCode
{
    private Search $search;
    private $driver;


    public function __construct(Search $search, $driver)
    {
        $this->search = $search;
        $this->driver = $driver;
    }

    public function copyCode()
    {

        // Находим кнопку по её XPath и кликаем на неё
        $buttonXPath = "(//span[contains(@class,'copy-sku-section__CopySkuSectionStyledSpan-sc-90675a67-1 fbEBfk')])";
        $this->driver->findElement(WebDriverBy::xpath($buttonXPath))->click();


        error_log("Кнопка кликнута, ожидаем появления инпута.");


        $elementLocator = WebDriverBy::xpath("//input[@class='Input__InputStyled-sc-278b7418-1 wwrjv']");
        $element = $this->driver->findElement($elementLocator);


        // Прокручиваем страницу к найденному элементу
        $this->driver->executeScript('arguments[0].scrollIntoView(true);', [$element]);
        error_log("Скролл к элементу.");
        
        
        // Дожидаемся, пока инпут станет видимым
        $inputXPath = "//input[@class='Input__InputStyled-sc-278b7418-1 wwrjv']";
        $inputElement = $this->driver->wait(10)->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath($inputXPath))
        );
        

        // Логгируем шаг
        error_log(" инпут появился.");


        // Получаем текст из буфера обмена и сохраняем его в JavaScript-переменной
        $this->driver->executeScript('window.copiedValue = navigator.clipboard.readText();');

// Получаем значение из JavaScript-переменной и вставляем его в инпут
        $copiedValue = $this->driver->executeScript('return window.copiedValue;');
        $inputElement->sendKeys([$copiedValue]);


        // Логгируем шаг
        error_log("Текст из буфера обмена: $copiedValue.");

        // Очищаем инпут
        $inputElement->clear();

        // Вставляем скопированный текст напрямую в инпут
        $inputElement->sendKeys($copiedValue);

        // Логгируем шаг
        error_log("Значение вставлено в инпут.");

        // Имитируем нажатие клавиши Enter
        $inputElement->sendKeys(['Enter']);

        // Логгируем шаг
        error_log("Клавиша Enter нажата.");

        // Дождитесь, пока страница обновится
        sleep(1);
    }

}