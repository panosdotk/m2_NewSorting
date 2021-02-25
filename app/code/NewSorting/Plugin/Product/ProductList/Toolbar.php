<?php
namespace Webgraphee\NewSorting\Plugin\Product\ProductList;

class Toolbar
{

    public function aroundSetCollection(
        \Magento\Catalog\Block\Product\ProductList\Toolbar $subject,
        \Closure $proceed,
        $collection
    ) {
        $currentOrder = $subject->getCurrentOrder();
        $result = $proceed($collection);

        if ($currentOrder) {
            if ($currentOrder == 'created_at') {
                $subject->getCollection()->setOrder('created_at', 'desc');
            }
        }

        /*
                if ($currentOrder) {
                    if ($currentOrder == 'price_desc') {
                        $subject->getCollection()->setOrder('price', 'desc');
                    } elseif ($currentOrder == 'price_asc') {
                        $subject->getCollection()->setOrder('price', 'asc');
                    }
                }
        */

        return $result;
    }
}