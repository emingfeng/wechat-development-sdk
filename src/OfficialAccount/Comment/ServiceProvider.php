<?php

namespace eMingFeng\OfficialAccount\Comment;

use eMingFeng\Kernel\core\Container;
use eMingFeng\Kernel\interfaces\Provider;

class ServiceProvider implements Provider
{
    public function serviceProvider(Container $container)
    {
        $container['comment'] = function ($container){
            return new Client($container);
        };
    }
}
