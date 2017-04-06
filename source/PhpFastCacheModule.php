<?php

namespace Spiral;

use Spiral\Core\DirectoriesInterface;
use Spiral\Modules\ModuleInterface;
use Spiral\Modules\PublisherInterface;
use Spiral\Modules\RegistratorInterface;
use Spiral\PhpFastCache\Config;

class PhpFastCacheModule implements ModuleInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(RegistratorInterface $registrator)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function publish(PublisherInterface $publisher, DirectoriesInterface $directories)
    {
        $publisher->publish(
            __DIR__ . '/config/cache.php',
            $directories->directory('config') . Config::CONFIG . '.php',
            PublisherInterface::FOLLOW
        );
    }
}