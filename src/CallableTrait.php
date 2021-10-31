<?php
/**
 * @package     HitarthPattani\EasyVersionUpgrade
 * @author      Hitarth Pattani <hitarthpattani@gmail.com>
 * @copyright   Copyright © 2021. All rights reserved.
 */
declare(strict_types=1);

namespace HitarthPattani\EasyVersionUpgrade;

trait CallableTrait
{
    /**
     * Call a callable if $version > $currentVersion
     *
     * @param string $version
     * @param string $currentVersion
     * @param callable $callable
     * @return null|void
     */
    public function runWith(string $version, string $currentVersion, callable $callable)
    {
        return version_compare($version, $currentVersion) === 1 ? $callable() : null;
    }
}
