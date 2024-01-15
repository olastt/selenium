<?php
namespace Src\Module;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;

class SearchDisks
{
    public Search $search;

    public function __construct(Search $search)
    {
        $this->search = $search;
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function clickOnDisks(): void
    {
        $this->search->clickByXpath("(//a[text()='Диски'])[2]");
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function clickOnTypeDisk()
    {
        // клик по радио кнопке "литой"
        $this->search->clickByXpath("//div[text()='Литой']");
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function clickOnBrand()
    {
        // клик по выпадающему списку "марка"
        $this->search->clickByXpath("//div[@class='sc-lbVpMG diwIhT']//select[1]");
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function clickOnModel()
    {
        // клик по названию "шкода"
        $this->search->clickByXpath("(//a[text()='SKODA'])[1]");
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function clickOnFabia()
    {
        // клик по названию "fabia"
        $this->search->clickByXpath("//a[text()='Fabia']");
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function clickOnRestylingCombi()
    {
        // клик по первой машине "II/Restyling Combi/2010-2014"
        $this->search->clickByXpath("//img[@alt='II/Restyling Combi/2010-2014']");
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function clickOnEngine()
    {
        // клик по объему двигателя
        $this->search->clickByXpath("(//td[text()='1.4'])[2]");
    }

}