<?php
/**
 * Created by PhpStorm.
 * User: machpng
 * Date: 2017/12/9
 * Time: 上午12:01
 */

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}