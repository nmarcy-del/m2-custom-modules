<?php

namespace Del01Promotion\Popup\Block;

use Del01Promotion\Popup\Helper\Config;
use Magento\Framework\Serialize\JsonConverter;
use Magento\Framework\View\Element\Template;

/**
 * Class Popup
 * @package Del01Promotion\Popup\Block
 */
class Popup extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var JsonConverter
     */
    protected $jsonConverter;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $filterProvider;

    /**
     * Popup constructor.
     * @param Template\Context $context
     * @param Config $config
     * @param JsonConverter $jsonConverter
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Config $config,
        JsonConverter $jsonConverter,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->config = $config;
        $this->jsonConverter = $jsonConverter;
        $this->filterProvider = $filterProvider;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->config->isEnabled();

    }

    /**
     * @return bool
     */
    public function isShow() {
        $area = $this->getDisplayArea();
        $page = $this->getPageArea();
        if($area == 'all') {
            return true;
        }
        if($area == $page) {
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getFormActionUrl()
    {
        $type = $this->config->getConfig('type');
        switch($type) {
            case 'banner':
                return '';
                break;
            case 'coupon':
                return $this->getUrl('promopopup/subscriber/send');
                break;
            case 'newsletter':
                return $this->getUrl('promopopup/subscriber/new');
                break;
        }
        return '';
    }

    /**
     * @return mixed
     */
    public function getDisplayType(){
        return $this->config->getConfig('type');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getContent(){
        $content = $this->config->getConfig('content');
        return $this->filterProvider->getPageFilter()->filter($content);
    }


    /**
     * @return mixed
     */
    public function getDisplayArea(){
        return $this->config->getConfig('area');
    }

    /**
     * @return string
     */
    public function getPageArea(){
        $request = $this->getRequest();
        if( $request->getFullActionName() == 'cms_index_index' ) {
            return 'home';
        } else if ( $request->getFullActionName() == 'checkout_cart_index' )  {
            return 'checkout';
        }
        return 'all';
    }

    /**
     * @return mixed
     */
    public function getLimit() {
        return $this->config->getConfig('limit');
    }

    public function getDelay(){
        return $this->config->getConfig('delay')*1000;
    }

    public function getPopupStartTime() {
        return $this->config->getConfig('popup_start_time');
    }

    public function getPopupEndTime() {
        return $this->config->getConfig('popup_end_time');
    }

    public function getResetDay() {
        return $this->config->getConfig('reset_day');
    }

    /**
     * @return string
     */
    public function getModalId() {
        return $this->config->getConfig('modal_id');
    }

    public function getJsonConfig() {
        return $this->jsonConverter->convert([
            'id'=> $this->getModalId(),
            'delay'=>$this->getDelay(),
            'limit'=> $this->config->getConfig('limit'),
            'type'=>$this->getDisplayType(),
            'area'=>$this->getDisplayArea(),
            'scenario'=>$this->config->getConfig('scenario'),
            'scrollCount'=>$this->config->getConfig('scroll_count'),
            'modalSelector'=>'.'.$this->getModalId().'-custom-promo-popup',
            'url'=>$this->getFormActionUrl(),
            'popupStartTime'=>$this->getPopupStartTime(),
            'popupEndTime'=>$this->getPopupEndTime(),
            'resetDay'=>$this->getResetDay(),
        ]);
    }
}
