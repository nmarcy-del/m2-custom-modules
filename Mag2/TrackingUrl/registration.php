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

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Mag2_TrackingUrl',
    __DIR__
);