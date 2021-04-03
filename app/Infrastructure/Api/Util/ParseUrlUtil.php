<?php

declare(strict_types=1);

namespace Api\Util;

class ParseUrlUtil
{

    private static array $request;

    public static function getRoute(): object
    {
        $url = self::getUrl();
        #var_dump($url);

        self::$request['route'] = strtolower($url[0]);
        self::$request['resource'] = $url[1] ?? null;
        self::$request['id'] = $url[2] ?? null;
        self::$request['method'] = strtolower($_SERVER['REQUEST_METHOD']);
        # var_dump(self::$request['method']);

        return (object) self::$request;
    }

    private static function getUrl(): array
    {
        $uri = str_replace("/" . DIR_PROJECT, '', $_SERVER['REQUEST_URI']);
        return explode("/", trim($uri, "/"));
    }
}
