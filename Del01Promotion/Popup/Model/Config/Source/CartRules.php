<?php

namespace Del01Promotion\Popup\Model\Config\Source;

/**
 * Class CartRules
 * @package Del01Promotion\Popup\Model\Config\Source
 */
class CartRules implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    protected $_options;


    /**
     * Collection object
     *
     * @var \Magento\Framework\Data\Collection
     */
    protected $_collection;


    /**
     * CartRules constructor.
     * @param \Magento\SalesRulePromotion\Model\ResourceModel\Rule\CollectionFactory $collectionFactory
     */
    public function __construct(
        \Magento\SalesRulePromotion\Model\ResourceModel\Rule\CollectionFactory $collectionFactory
    ) {
        $this->_collection = $collectionFactory->create();
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = [];
            foreach ($this->_collection->getItems() as $item) {
                $id = $item->getRuleId();
                $name = $item->getName();
                $this->_options[] = ['value' => $id, 'label' => $name];
            }
        }
        return $this->_options;
    }
}
