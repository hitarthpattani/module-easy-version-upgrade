# Easy Version Upgrade Library

A PHP library with a simple trait is used to run setup upgrades with the version.

## Installation

```bash
composer config repositories.hitarthpattani-git vcs https://github.com/hitarthpattani/module-easy-version-upgrade.git
composer require hitarthpattani/module-easy-version-upgrade:dev-master
bin/magento setup:upgrade
```

## Usage

This is a trait that can be used to compare version upgrades for magento2 module setup and data upgrade scripts. Use following magento2 setup scripts as an example:

```bash
<?php
/**
 * @package     HitarthPattani\SampleEasyVersionUpgrade
 * @author      Hitarth Pattani <hitarthpattani@gmail.com>
 * @copyright   Copyright © 2021. All rights reserved.
 */
declare(strict_types=1);

namespace HitarthPattani\SampleEasyVersionUpgrade\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use HitarthPattani\EasyVersionUpgrade\CallableTrait;

class UpgradeEasyVersionAttributes implements UpgradeDataInterface
{
    /**
     * Use upgrade trait
     */
    use CallableTrait;

    /**
     * @var EavSetup
     */
    private $eavSetupFactory;

    /**
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $version = $context->getVersion();

        /** @var EavSetup $eav */
        $eav = $this->eavSetupFactory->create(['setup' => $setup]);

        $this->runWith('1.0.0', $version, function () use ($eav) {
            // First version changes
        });

        $this->runWith('1.0.1', $version, function () {
            // Second version changes
        });
    }
}
```
