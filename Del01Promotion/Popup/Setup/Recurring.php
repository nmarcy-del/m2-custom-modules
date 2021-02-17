<?php

namespace Del01Promotion\Popup\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class Recurring
 * @package Del01Promotion\Popup\Setup
 */
class Recurring implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $this->installFileData();
        $installer->endSetup();
    }

    protected function installFileData()
    {
        $mediaPath = BP . '/pub/media/promopopup/';
        $dataPath = dirname(__FILE__) . '/Data/promopopup/';

        $folders = [
            'templates',
            'images/universal/popup',
            'images/free-shipping/popup',
        ];

        $files = [
            'templates/1-1_universal_newsletter.html',
            'templates/1-2_universal_coupon.html',
            'templates/1-3_universal_banner.html',
            'images/universal/popup/1.png',

            'images/free-shipping/popup/logo-chrono.png',
            'images/free-shipping/popup/logo-chrono-2.png',
        ];

        /*Create Folder*/
        foreach ($folders as $item) {
            @\mkdir($mediaPath . $item, 0777, true);
        }

        /*Copy files*/
        foreach ($files as $item) {
            @\copy($dataPath . $item, $mediaPath . $item);
        }

    }
}
