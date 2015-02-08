<?php namespace credits\Components\ACL;

use Illuminate\Support\Facades\Facade;


class ACL extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ACL';
    }

}

