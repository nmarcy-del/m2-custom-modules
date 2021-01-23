<?php

/**
 * DISCLAIMER
 *
 * @category  Mag2
 * @package   Mag2\RapidCarrierList
 * @author    Nathan Marcy <nathan.marcy@live.fr>
 * @copyright 2021 nmarcy
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Mag2\RapidCarrierList\Controller\All;

use Magento\Config\Model\Config\Source\Locale\Currency\All;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Shipping\Model\Config\Source\Allmethods as AllCarrierCode;

/**
 * Class View
 * @package Therascience\ActiveCarrierList\Controller\All
 */
class Carrier extends Action
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