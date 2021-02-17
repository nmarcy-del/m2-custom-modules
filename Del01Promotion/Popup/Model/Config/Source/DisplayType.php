<?php

namespace Del01Promotion\Popup\Model\Config\Source;

/**
 * Class DisplayType
 * @package Del01Promotion\Popup\Model\Config\Source
 */
class DisplayType implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'banner', 'label' => __('Banner')],
            ['value' => 'coupon', 'label' => __('Promo coupon')],
            ['value' => 'newsletter', 'label' => __('Newsletter')],
        ];
    }
}
