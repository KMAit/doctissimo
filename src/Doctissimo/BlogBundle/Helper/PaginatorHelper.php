<?php

/**
 * Created by PhpStorm.
 * User: Kamel
 * Date: 07/06/2019
 * Time: 19:58
 */

namespace Doctissimo\BlogBundle\Helper;


class PaginatorHelper
{
    const GENERIC_ITEM_PAGE = 5;
    const PAGES_ITERATION = 3;

    /** @var int $currentPage */
    private $currentPage;

    /** @var int $maxItems */
    private $maxItems;

    /** @var int $itemsByPage */
    private $itemsByPage;

    /**
     * PaginatorHelper constructor.
     * @param $currentPage
     */
    public function __construct($currentPage = 1)
    {
        $this->setCurrentPage((int) $currentPage);
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return int
     */
    public function getMaxItems()
    {
        return $this->maxItems;
    }

    /**
     * @param int $maxItems
     */
    public function setMaxItems($maxItems)
    {
        $this->maxItems = $maxItems;
    }

    /**
     * @return int
     */
    public function getItemsByPage()
    {
        return $this->itemsByPage;
    }

    /**
     * @param int $itemsByPage
     */
    public function setItemsByPage($itemsByPage)
    {
        $this->itemsByPage = $itemsByPage;
    }

    /**
     * @return float
     * @internal param int $itemsByPage
     */
    public function getMaximumPages()
    {
        $itemsByPage = self::GENERIC_ITEM_PAGE;

        if ($this->getItemsByPage() !== null) {
            $itemsByPage = $this->getItemsByPage();
        }


        $pages = ($this->getMaxItems() / $itemsByPage);

        return ceil($pages);
    }

    /**
     * @return array
     */
    public function getNavigationIteration()
    {
        $currentPage = $this->getCurrentPage();
        $pages = [];

        if ($currentPage !== null) {
            //Pages before current page
            for ($i = 1; $i < $currentPage; ++$i) {
                if (($pageIteration = $currentPage - $i) <= self::PAGES_ITERATION) {
                    $pages[] = $i;
                }
            }

            //Adding current page
            $pages[] = $currentPage;

            //Pages before after page
            for ($i = $currentPage; $i < $this->getMaximumPages(); ++$i) {
                if (($pageIteration = $i - $currentPage) <= self::PAGES_ITERATION) {
                    $pages[] = $i + 1;
                }
            }

            return $pages;
        }

        return [];
    }

    /**
     * @return array
     */
    public function getStatsDisplay()
    {
        $toItems = $this->getCurrentPage() * $this->getItemsByPage();

        if ($toItems > $this->getMaxItems()) {
            $toItems = $this->getMaxItems();
        }

        return [
            'fromItems' => (($this->getCurrentPage() -1) * $this->getItemsByPage()),
            'toItems' => $toItems,
            'maxItems'     => $this->getMaxItems()
        ];
    }

}