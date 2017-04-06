<?php

namespace Spiral\Tests\PhpFastCache;

use Psr\SimpleCache\CacheInterface;
use Spiral\PhpFastCache\CacheBootloader;
use Spiral\Tests\BaseTest;

/**
 * Class CacheTest
 *
 * @package Spiral\Tests\PhpFastCache
 * @property CacheInterface $cache
 */
class CacheTest extends BaseTest
{
    const NAME  = 'some-name';
    const VALUE = 'some-value';

    public function testCaching()
    {
        $this->app->getBootloader()->bootload([CacheBootloader::class]);
        $this->cache->set(self::NAME, self::VALUE);

        $default = 'some-default';
        $this->assertEquals($default, $this->cache->get('some-other-key', $default));

        $this->assertEquals(self::VALUE, $this->cache->get(self::NAME));
    }

    public function testCalls()
    {
        $this->app->getBootloader()->bootload([CacheBootloader::class]);
        $this->app->callAction(CacheController::class, 'set');

        $this->assertEquals(self::VALUE, $this->app->callAction(CacheController::class, 'get'));
    }
}