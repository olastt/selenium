<?php

namespace Src\Module;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;


class SearchTiresBlock
{
    private Search $search;

    public function __construct(Search $search)
    {
        $this->search = $search;
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function clickOnSummer()
    {
        $this->search->clickByXpath("(//span[@class='main-page_radioOptions__checkmark__Q5g01'])[1]");
        sleep(1);
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function checkWidth(string $width)
    {
        $this->search->clickByXpath("(//select[@class='main-page_sectionOptions__itemSelect__m0Af3'])[1]");
        sleep(1);
        $this->search->clickByXpath("//option[text()='{$width}']");
        sleep(1);
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function searchCheckBox()
    {
        $this->search->clickByXpath("//label[text()='Новинки']");
        sleep(1);
    }

    /**
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    public function searchPickUp()
    {
        $this->search->clickByXpath("(//button[@type='submit'])[1]");
        sleep(1);
    }
}