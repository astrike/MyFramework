<?php
/**
 * Created by PhpStorm.
 * User: astri
 * Date: 2019-03-28
 * Time: 10:51
 */

namespace SDK\Facades;


class Image extends Facade
{
    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Image';
    }
}