<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitab6c692a5604021a06687592c31fbfef
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Whoops\\' => 7,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Whoops\\' => 
        array (
            0 => __DIR__ . '/..' . '/filp/whoops/src/Whoops',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitab6c692a5604021a06687592c31fbfef::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitab6c692a5604021a06687592c31fbfef::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
