<?php

namespace Spiral\PhpFastCache;

use phpFastCache\CacheManager;
use Psr\Cache\CacheItemPoolInterface;
use Psr\SimpleCache\CacheInterface;
use Spiral\Core\Bootloaders\Bootloader;

class CacheBootloader extends Bootloader
{
    const BINDINGS = [
        'cache'               => CacheInterface::class,
        CacheInterface::class => SimpleCacheAdapter::class
    ];

    const SINGLETONS = [
        CacheItemPoolInterface::class => [self::class, 'makeCache']
    ];

    protected function makeCache(Config $config): CacheItemPoolInterface
    {
        return CacheManager::getInstance($config->getAdapter(), $config->getAdapterOptions());
    }
}