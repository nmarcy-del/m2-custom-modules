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

namespace Del01Promotion\DailyTimedPromotion\Plugin\DailyTimedPromotion\Model;

use Del01Promotion\DailyTimedPromotion\Helper\Data;
use Magento\SalesRulePromotion\Model\Utility;
use Magento\Quote\Model\Quote\Address;
use Magento\SalesRulePromotion\Model\Rule as ApplicableRule;

/**
 * Class UtilityPlugin
 * @package Del01Promotion\DailyTimedPromotion\Plugin\DailyTimedPromotion\Model
 */
class UtilityPlugin
{
    /** @var Address */
    private $ruleAddress;

    /** @var ApplicableRule */
    private $applicableRule;

    /**@var Data**/
    protected $ruleTimer;

    /**
     * UtilityPlugin constructor.
     * @param Data $ruleTimer
     */
    public function __construct
    (
        Data $ruleTimer
    )
    {
        $this->ruleTimer = $ruleTimer;
    }

    /**
     * @param Utility $subject
     * @param $rule
     * @param $address
     * @return array
     */
    public function beforeCanProcessRule(Utility $subject, $rule, $address)
    {
        $this->ruleAddress = $address;
        $this->applicableRule = $rule;

        return [$rule, $address];
    }

    /**
     * @param Utility $subject
     * @param $result
     * @return bool|mixed
     */
    public function afterCanProcessRule(Utility $subject, $result)
    {
        if ($result !== true) {
            return $result;
        }

        $startTime = $this->applicableRule->getDel01PromotionStartTime();
        $endTime = $this->applicableRule->getDel01PromotionEndTime();

        if ($startTime && $endTime) {
            return $this->ruleTimer->isRuleTimedOff($startTime, $endTime);
        }

        return $result;
    }
}