<?php
namespace Webgraphee\NewSorting\Plugin\Model;

use Magento\Store\Model\StoreManagerInterface;

class Config  {


    protected $_storeManager;

    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }


    public function afterGetAttributeUsedForSortByArray(\Magento\Catalog\Model\Config $catalogConfig, $options)
    {
        $store = $this->_storeManager->getStore();
        $currencySymbol = $store->getCurrentCurrency()->getCurrencySymbol();

        // Remove specific default sorting options
        $default_options = [];
        $default_options['name'] = $options['name'];

        unset($options['position']);
        unset($options['name']);
        // unset($options['price']);

        //Changing label
        $customOption['position'] = __( ' Popular' );

        //New sorting options
        $customOption['created_at'] = __( ' New Arrivals' );
        // If enable this, uncomment line 29
        // $customOption['price_desc'] = __($currencySymbol.' (High to Low)');
        // $customOption['price_asc'] = __($currencySymbol.' (Low to High)');


        $customOption['name'] = $default_options['name'];

        //Merge default sorting options with custom options
        $options = array_merge($customOption, $options);

        return $options;
    }
}