<?php

namespace SDK\Facades;

class isAdmin extends Facade
{
    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'isAdmin';
    }
}