<?php
/**
 * Created by PhpStorm.
 * User: Rawrkatsorg
 * Date: 13/07/2017
 * Time: 15:17
 */

namespace Rawrkats\Smilies\Facades;

use Illuminate\Support\Facades\Facade;

final class Smilies extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'smilies';
    }
}
