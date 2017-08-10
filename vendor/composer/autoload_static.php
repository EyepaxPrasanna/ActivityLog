<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitebc275d30cd61d3d0785e989092bbc8c
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Eyepax\\ActivityLog\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Eyepax\\ActivityLog\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitebc275d30cd61d3d0785e989092bbc8c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitebc275d30cd61d3d0785e989092bbc8c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
