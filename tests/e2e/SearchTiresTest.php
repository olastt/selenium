<?php

namespace e2e;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use PHPUnit\Framework\TestCase;
use Src\Module\LinksAll;
use Src\Module\Search;
use Src\Module\SearchTiresBlock;


class SearchTiresTest extends TestCase
{
    protected RemoteWebDriver $driver;

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
        $startUrl = "https://www.shinservice.ru/";
        $this->driver->get($startUrl);
    }

    public function tearDown(): void
    {
        $this->driver->quit();
    }

    /**
     * @throws TimeoutException
     * @throws NoSuchElementException
     */
    public function testBlock(): void
    {
        $search = new Search($this->driver);
        $searchTires = new SearchTiresBlock($search);
        $searchTires->clickOnSummer();
        $searchTires->checkWidth('35');
        $searchTires->searchCheckBox();
        $searchTires->searchPickUp();
        $links = new LinksAll($this->driver);
        $links->SeasonSummer();
        // проверяем, что на странице в HTML присутствует текст
        $this->assertStringContainsString('Новинки летних шин 35', $this->driver->getPageSource());
        sleep(1);
    }
}
