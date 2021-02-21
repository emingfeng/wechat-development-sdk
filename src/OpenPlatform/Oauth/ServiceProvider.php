<?php


namespace eMingFeng\OpenPlatform\Oauth;

use eMingFeng\Kernel\core\Container;

use eMingFeng\Kernel\interfaces\Provider;

class ServiceProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
        $container['oauth'] = function ($container){
            return new Client($container->options);
        };
    }
}
