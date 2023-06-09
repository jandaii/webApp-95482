<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit71f2a30b508878cb5829525b8e662f4c
{
    public static $prefixLengthsPsr4 = array (
        'v' => 
        array (
            'voku\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'voku\\' => 
        array (
            0 => __DIR__ . '/..' . '/voku/stop-words/src/voku',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit71f2a30b508878cb5829525b8e662f4c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit71f2a30b508878cb5829525b8e662f4c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit71f2a30b508878cb5829525b8e662f4c::$classMap;

        }, null, ClassLoader::class);
    }
}
