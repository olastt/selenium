<?php

namespace e2e;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;
use PHPUnit\Framework\TestCase;
use Src\Module\Search;
use Src\Module\SearchDisks;

// Исправлено пространство имен

class SearchDisksTest extends TestCase
{
    protected RemoteWebDriver $driver;
    private Search $search;

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
        $this->search = new Search($this->driver);
        $this->startUrl = "https://www.shinservice.ru/";
        $this->driver->get($this->startUrl);
    }

    public function tearDown(): void
    {
        $this->driver->quit();
    }

    /**
     * @throws TimeoutException|NoSuchElementException
     */
    public function testSearchDisks()
    {
            $searchDisks = new SearchDisks($this->search);
            $searchDisks->clickOnDisks();
            $searchDisks->clickOnTypeDisk();
            $searchDisks->clickOnBrand();
            $searchDisks->clickOnModel();
            $searchDisks->clickOnFabia();
            $searchDisks->clickOnRestylingCombi();
            $searchDisks->clickOnEngine();

            // проверяем, что на странице в HTML присутствует текст
            $this->assertStringContainsString('SKODA Fabia II/Restyling Combi/2010-2014 1.4', $this->driver->getPageSource());
            sleep(1);

            // клик чтобы скопировать
            $this->search->clickByXpath("(//span[contains(@class,'copy-sku-section__CopySkuSectionStyledSpan-sc-90675a67-1 fbEBfk')])[1]");
            sleep(1);

            // ожидание появления элемента (всплывающего окна)
            $wait = new WebDriverWait($this->driver, 1);
            $wait->until(
                WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="stp-main-header-wrapper"]/div[2]'))
            );
    }
}
