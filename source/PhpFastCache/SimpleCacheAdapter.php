<?php

namespace Spiral\PhpFastCache;

use phpFastCache\Cache\ExtendedCacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\SimpleCache\CacheInterface;
use Spiral\PhpFastCache\Exceptions\SpiralFastCacheException;

class SimpleCacheAdapter implements CacheInterface
{
    /**
     * @var CacheItemPoolInterface
     */
    protected $pool;

    /**
     * PSR16Adapter constructor.
     *
     * @param CacheItemPoolInterface $pool
     */
    public function __construct(CacheItemPoolInterface $pool)
    {
        $this->pool = $pool;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        try {
            $value = $this->pool->getItem($key)->get();
            if ($value !== null) {
                return $value;
            } else {
                return $default;
            }
        } catch (\Throwable $e) {
            throw new SpiralFastCacheException($e->getMessage(), $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value, $ttl = null)
    {
        try {
            $item = $this->pool
                ->getItem($key)
                ->set($value);
            if (is_int($ttl) || $ttl instanceof \DateInterval) {
                $item->expiresAfter($ttl);
            }

            return $this->pool->save($item);
        } catch (\Throwable $e) {
            throw new SpiralFastCacheException($e->getMessage(), $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        try {
            return $this->pool->deleteItem($key);
        } catch (\Throwable $e) {
            throw new SpiralFastCacheException($e->getMessage(), $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        try {
            return $this->pool->clear();
        } catch (\Throwable $e) {
            throw new SpiralFastCacheException($e->getMessage(), $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getMultiple($keys, $default = null)
    {
        try {
            return array_map(function (ExtendedCacheItemInterface $item) {
                return $item->get();
            }, $this->pool->getItems($keys));
        } catch (\Throwable $e) {
            throw new SpiralFastCacheException($e->getMessage(), $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setMultiple($values, $ttl = null)
    {
        try {
            foreach ($values as $key => $value) {
                $item = $this->pool->getItem($key)->set($value);
                $this->pool->saveDeferred($item);
                unset($item);
            }

            return $this->pool->commit();
        } catch (\Throwable $e) {
            throw new SpiralFastCacheException($e->getMessage(), $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function deleteMultiple($keys)
    {
        try {
            return $this->pool->deleteItems($keys);
        } catch (\Throwable $e) {
            throw new SpiralFastCacheException($e->getMessage(), $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        try {
            return $this->pool->getItem($key)->isHit();
        } catch (\Throwable $e) {
            throw new SpiralFastCacheException($e->getMessage(), $e->getMessage(), $e);
        }
    }
}