<?php

/**
 * DISCLAIMER
 *
 * @category  Del01TrackingUrl
 * @package   Del01TrackingUrl\TrackingUrl
 * @author    Del01
 * @copyright 2021 del01
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Del01TrackingUrl\TrackingUrl\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Sales\Model\Order\Shipment as OrderShipment;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Framework\App\Helper\AbstractHelper;


/**
 * Class Data
 * @package Del01TrackingUrl\TrackingUrl\Helper
 */
class Data extends AbstractHelper
{
    /** @var OrderShipment */
    protected $shipment;

    public function __construct
    (
        Context $context,
        OrderShipment $shipement
    )
    {
        $this->shipment = $shipement;
        parent::__construct($context);
    }


    /**
     * Retrieve carrier url
     *
     * @param string $carrierCode
     * @param string|null $store
     * @return string
     */
    public function getCarrierUrl($carrierCode, $store = null)
    {
        if ($carrierUrl = $this->getConfig("del01_tracking/service_url/{$carrierCode}", $store)) {
            return $carrierUrl;
        }
        return false;
    }

    /**
     * Retrieve Store Configuration Data
     *
     * @param string $path
     * @param string|null $store
     * @return mixed
     */
    protected function getConfig($path, $store = null)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $store);
    }

    /**
     * RetriveShipement by shipment increment id
     *
     * @param $incrementId
     * @return mixed
     */
    public function getShipmentByIncrementId($incrementId) {
        $shipment = $this->shipment->setId(null)->loadByIncrementId($incrementId);
        return $shipment;
    }
}