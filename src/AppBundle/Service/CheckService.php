<?php

namespace AppBundle\Service;

use AppBundle\Entity\Check;
use AppBundle\Repository\StockRepository;

/**
 * Class CheckService
 */
class CheckService
{
    /**
     * @var StockRepository
     */
    private $stockRepository;

    /**
     * CheckService constructor.
     *
     * @param StockRepository $stockRepository
     */
    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    /**
     * @param Check $check
     *
     * @return void
     */
    public function updateStockFromDeletedCheck(Check $check)
    {
        $bin = $check->getBin();
        $bar = $check->getBar();

        foreach ($bin as $value) {
            $product = $value->getProduct();
            $recept = $product->getRecept();

            foreach ($recept as $receptItem) {
                $stockIngredient = $this->stockRepository->getIngredientInBar($receptItem->getIngredient(), $bar);
                $stockIngredient->increase($receptItem->getCount());
                $this->stockRepository->updateStock($stockIngredient);
            }
        }
    }
}
