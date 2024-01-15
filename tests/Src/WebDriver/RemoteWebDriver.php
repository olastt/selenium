<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

// URL, где запущен Selenium Server
$host = 'http://localhost:4444/wd/hub'; // Пример URL, укажите свой

// Желаемые настройки (браузер, версия и т.д.)
$capabilities = DesiredCapabilities::chrome(); // Используется Chrome, но можно выбрать другой браузер

// Инициализация драйвера
$driver = RemoteWebDriver::create($host, $capabilities);
