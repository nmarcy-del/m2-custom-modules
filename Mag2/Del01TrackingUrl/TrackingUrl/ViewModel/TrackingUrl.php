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

namespace Del01TrackingUrl\TrackingUrl\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Del01TrackingUrl\TrackingUrl\Block\Track;
use Del01TrackingUrl\TrackingUrl\Helper\Data;

/**
 * Class TrackingUrl
 * @package Del01TrackingUrl\TrackingUrl\ViewModel
 */
class TrackingUrl implements ArgumentInterface
{
    /** @var Track */
    protected $trackUrlGenerator;

    /** @var Data */
    protected $trackingHelper;

    /**
     * TrackingUrl constructor.
     * @param Track $trackUrlGenerator
     * @param Data $trackingHelper
     */
    public function __construct
    (
        Track $trackUrlGenerator,
        Data $trackingHelper
    )
{
    $this->trackUrlGenerator = $trackUrlGenerator;
    $this->trackingHelper = $trackingHelper;
}

    public function getTrackingUrl($shipId, $track)
    {
        $currentShipment = $this->trackingHelper->getShipmentByIncrementId($shipId);

        foreach ($currentShipment->getTracksCollection() as $item){
            if ($item->getCarrierCode() === $track->getCarrier()){
                return $this->trackUrlGenerator->getTrackingUrl($item);
            }
        }
        return false;
    }
}