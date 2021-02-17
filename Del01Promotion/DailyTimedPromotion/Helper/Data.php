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

namespace Del01Promotion\DailyTimedPromotion\Helper;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface as Date;
use Magento\SalesRulePromotion\Api\RuleRepositoryInterface;

/**
 * Class Data
 * @package Del01Promotion\DailyTimedPromotion\Helper
 */
class Data
{
    /** @var Date */
    protected $date;

    /*** @var RuleRepositoryInterface */
    protected $ruleRepositoryInterface;

    /**
     * Time constructor.
     * @param Date $date
     * @param RuleRepositoryInterface $ruleRepositoryInterface
     */
    public function __construct
    (
        Date $date,
        RuleRepositoryInterface $ruleRepositoryInterface
    )
    {
        $this->date =  $date;
        $this->ruleRepositoryInterface = $ruleRepositoryInterface;
    }

    /**
     * @return string
     */
    public function getCurrentTime()
    {
        $date = $this->date->date();
        return $this->date->date($date)->format("H:i");
    }

    /**
     * @param $startTime
     * @param $endTime
     * @return bool
     */
    public function isRuleTimedOff($startTime, $endTime)
    {
        if ($startTime && $endTime ) {
            $this->date->date($startTime)->format("H:i");
            $this->date->date($endTime)->format("H:i");
            if ($startTime < $this->getCurrentTime() && $endTime > $this->getCurrentTime()){
                return true;
            }
        }
        return false;
    }
}