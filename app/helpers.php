<?php

if (! function_exists('navbar_item_class')) {
    function navbar_item_class($routeName)
    {
        return request()->routeIs($routeName)  ? 'active' : 'text-dark';
    }
}
