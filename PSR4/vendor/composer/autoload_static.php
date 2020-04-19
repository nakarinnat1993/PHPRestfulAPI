<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitca4e2a00d3fc682dd810c5d5bf92c18e
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'BasicAPI\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'BasicAPI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitca4e2a00d3fc682dd810c5d5bf92c18e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitca4e2a00d3fc682dd810c5d5bf92c18e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
