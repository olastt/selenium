<?php


namespace e2e\mainPage;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;
use Src\Module\CopyCode;
use Src\Module\LinksAll;
use Src\Module\Search;
use Src\Module\SearchTiresBlock;


class SearchAndCopyCodeProductTest extends TestCase
{
    protected RemoteWebDriver $driver;
    private $search;


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
    public function testCode(): void
    {

        $search = new Search($this->driver);
        $searchTires = new SearchTiresBlock($search);
        $searchTires->clickOnSummer();
        $searchTires->checkWidth('35');
        $searchTires->searchCheckBox();
        $searchTires->searchPickUp();
        $links = new LinksAll($this->driver);
        $links->SeasonSummer();
        $code = new CopyCode($search, $this->driver);
        $code->copyCode();
        $this->assertStringContainsString('Код товара: 1094981', $this->driver->getPageSource());
    }

}
