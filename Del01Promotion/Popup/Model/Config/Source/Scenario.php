<?php

namespace Del01Promotion\Popup\Model\Config\Source;

/**
 * Class Scenario
 * @package Del01Promotion\Popup\Model\Config\Source
 */
class Scenario implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'delay', 'label' => __('Delay')],
            ['value' => 'scroll', 'label' => __('Scrolling')],
        ];
    }
}
