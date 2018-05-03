<?php

namespace SamWrigley\Hobnob\Facades;

use Illuminate\Support\Facades\Facade;

class SocialNetworkFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'social-network';
    }
}
