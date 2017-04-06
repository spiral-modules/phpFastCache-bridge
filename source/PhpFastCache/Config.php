<?php

namespace Spiral\PhpFastCache;

use Spiral\Core\InjectableConfig;

class Config extends InjectableConfig
{
    const CONFIG = 'modules/spiralPhpFastCache';

    /** @var array */
    protected $config = [
        'adapter'  => '',
        'adapters' => []
    ];

    /**
     * @return string
     */
    public function getAdapter(): string
    {
        return $this->config['adapter'];
    }

    /**
     * @return array
     */
    public function getAdapterOptions(): array
    {
        return $this->config['adapters'][$this->getAdapter()];
    }
}