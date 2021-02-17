<?php

/**
 * DISCLAIMER
 *
 * @category  Del01Promotion
 * @package   Del01Promotion\DailyTimedPromotion
 * @author    Nathan Marcy <nathan.marcy@live.fr>
 * @copyright 2021 nmarcy
 * @license   Open Software License ("OSL") v. 3.0
 */

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Del01Promotion_DailyTimedPromotion',
    __DIR__
);