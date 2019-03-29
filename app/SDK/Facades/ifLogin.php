<?php
/**
 * Created by PhpStorm.
 * User: astri
 * Date: 2019-03-28
 * Time: 22:10
 */

namespace SDK\Facades;


class ifLogin extends Facade
{
    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ifLogin';
    }
}