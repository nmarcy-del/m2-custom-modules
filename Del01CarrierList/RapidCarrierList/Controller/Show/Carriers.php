<?php

/**
 * DISCLAIMER
 *
 * @category  Del01CarrierList
 * @package   Del01CarrierList\TrackingUrl
 * @author    Del01
 * @copyright 2021 del01
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Del01CarrierList\RapidCarrierList\Controller\Show;

use Magento\Config\Model\Config\Source\Locale\Currency\All;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Shipping\Model\Config\Source\Allmethods as AllCarrierCode;

/**
 * Class Carriers
 * @package Del01CarrierList\RapidCarrierList\Controller\Show
 */
class Carriers extends Action
{
    /** @var AllCarrierCode */
    protected $allCarrierCode;

    /**
     * View constructor.
     * @param Context $context
     * @param AllCarrierCode $allCarrierCode
     */
    public function __construct
    (
        Context $context,
        AllCarrierCode $allCarrierCode
    )
    {
        $this->allCarrierCode = $allCarrierCode;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var Json $jsonResult */
        $jsonResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);
            $jsonResult->setData([
                $this->allCarrierCode->toOptionArray(true)
            ]);
        return $jsonResult;
    }
}