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

namespace Mag2\TrackingUrl\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\ResourceModel\Order\Shipment\Track\Collection;
use Magento\Sales\Model\ResourceModel\Order\Shipment\Track\CollectionFactory as TrackCollectionFactory;
use Mag2\TrackingUrl\Helper\Data as TrackingLinkHelper;

/**
 * Class Track
 * @package Mag2\TrackingUrl\Block
 */
class Track extends Template
{
    /** @var TrackingLinkHelper */
    protected $helper;

    /** @var Collection */
    protected $tracksCollection;

    /** @var TrackCollectionFactory */
    protected $trackCollectionFactory;

    /**
     * Track constructor.
     * @param Context $context
     * @param TrackingLinkHelper $helper
     * @param TrackCollectionFactory $trackCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        TrackingLinkHelper $helper,
        TrackCollectionFactory $trackCollectionFactory,
        array $data = []
    ) {
        $this->helper = $helper;
        $this->trackCollectionFactory = $trackCollectionFactory;

        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * Retrieve tracking url
     *
     * @param \Magento\Shipping\Model\Order\Track $track
     * @return string|null
     */
    public function getTrackingUrl($track)
    {
        $url = $this->helper->getCarrierUrl(
            $track->getCarrierCode(),
            (string)$track->getStoreId()
        );
        return $url ? str_replace('{{number}}', $track->getNumber(), $url) : null;
    }

    /**
     * Retrieve tracks collection
     *
     * @param integer $shipmentId
     * @return Collection
     */
    public function getTracksCollection($shipmentId)
    {
        if ($this->tracksCollection === null) {
            $this->tracksCollection = $this->trackCollectionFactory->create();
            $this->tracksCollection->setShipmentFilter($shipmentId);
        }
        return $this->tracksCollection;
    }
}