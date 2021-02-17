<?php

namespace Del01Promotion\Popup\Setup;

use Magento\Framework\Serialize\JsonConverter;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var \Magento\Cms\Model\BlockFactory
     */
    protected  $blockFactory;

    /**
     * @var JsonConverter
     */
    protected $jsonConverter;

    public function __construct(
        \Magento\Cms\Model\BlockFactory $blockFactory,
        JsonConverter $jsonConverter
    ) {
        $this->blockFactory = $blockFactory;
        $this->jsonConverter = $jsonConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->installFileData();

        $setup->endSetup();
    }

    /**
     * @param array $data
     * @return \Magento\Cms\Model\Block
     */
    protected function saveCmsBlock($data)
    {
        $cmsBlock = $this->blockFactory->create();
        $cmsBlock->getResource()->load($cmsBlock, $data['identifier']);
        if (!$cmsBlock->getData()) {
            $cmsBlock->setData($data);
        } else {
            $cmsBlock->addData($data);
        }
        $cmsBlock->setStores([\Magento\Store\Model\Store::DEFAULT_STORE_ID]);
        $cmsBlock->setIsActive(1);
        $cmsBlock->save();
        return $cmsBlock;
    }


    protected function installFileData() {
        $mediaPath = BP . '/pub/media/promopopup/';
        $dataPath = dirname(__FILE__) . '/Data/promopopup/';

        $folders =  [
                'templates'
            ];

        $files =  [];

        /*Create Folder*/
        foreach ($folders as $item) {
            @\mkdir($mediaPath.$item,0777,true);
        }

        /*Copy files*/
        foreach ($files as $item) {
            @\copy($dataPath.$item, $mediaPath.$item);
        }

    }
}
