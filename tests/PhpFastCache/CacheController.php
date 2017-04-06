<?php

namespace Spiral\Tests\PhpFastCache;

use Psr\SimpleCache\CacheInterface;
use Spiral\Core\Controller;

/**
 * Class CacheController
 *
 * @package Spiral\Tests\PhpFastCache
 * @property CacheInterface $cache
 */
class CacheController extends Controller
{
    public function setAction()
    {
        $this->cache->set(CacheTest::NAME, CacheTest::VALUE);
    }

    public function getAction()
    {
        return $this->cache->get(CacheTest::NAME);
    }
}