<?php
/**
 * Created by PhpStorm.
 * User: machp
 * Date: 2017/12/25
 * Time: 17:35
 */

namespace App\Observers;


use App\Models\Link;

class LinkObserver
{
    public function saved(Link $link)
    {
        \Cache::forget($link->cache_key);
    }
}