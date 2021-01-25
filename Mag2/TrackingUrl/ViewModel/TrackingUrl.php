<?php

/**
 * DISCLAIMER
 *
 * @category  Mag2
 * @package   Mag2\TrackingUrl
 * @author    Nathan Marcy <nathan.marcy@live.fr>
 * @copyright 2021 nmarcy
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Mag2\TrackingUrl\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Mag2\TrackingUrl\Block\Track;
use Mag2\TrackingUrl\Helper\Data;

/**
 * Class TrackingUrl
 * @package Mag2\TrackingUrl\ViewModel
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