<?php

namespace Del01Promotion\Popup\Model\Config\Source;

/**
 * Class DisplayArea
 * @package Del01Promotion\Popup\Model\Config\Source
 */
class DisplayArea implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'all', 'label' => __('All Pages')],
            ['value' => 'home', 'label' => __('Home Page')],
            ['value' => 'checkout', 'label' => __('Checkout (Shopping Cart)')],
        ];
    }
}
