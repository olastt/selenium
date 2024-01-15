<?php

namespace Src\e2e;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use PHPUnit\Framework\TestCase;

class Selenium extends TestCase
{
    protected RemoteWebDriver $driver;
    protected string $startUrl;

    public function setUp(): void
    {
        parent::setUp();

        $options = new ChromeOptions();
        $options->addArguments(['--window-size=1920,1080']);
        $caps = DesiredCapabilities::chrome();
        $caps->setCapability('version', "112.0");
        $caps->setCapability('browserName', "chrome");
        $caps->setCapability('enableVNC', true);
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);
        $this->driver = RemoteWebDriver::create("http://selenoid:4444/wd/hub/", $caps);
        $this->startUrl = "https://www.shinservice.ru/";
        $this->driver->get($this->startUrl);
    }

    public function tearDown(): void
    {
        $this->driver->quit();
        parent::tearDown();
    }
}