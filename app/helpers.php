<?php

use App\Services\Utils\Unsplash\UnsplashService;
use App\Services\Utils\UtilsService;
use App\Services\Utils\Version\VersionService;

if (!function_exists('version')) {
    function version(): VersionService
    {
        return new VersionService;
    }
}

if (!function_exists('unsplash')) {
    function unsplash(): UnsplashService
    {
        return new UnsplashService;
    }
}

if (!function_exists('utils')) {
    function utils(): UtilsService
    {
        return new UtilsService;
    }
}
