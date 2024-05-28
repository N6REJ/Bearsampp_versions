<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit736b3145a8ce3e551e2a494a8a58966e
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Akeeba\\UsageStats\\Collector\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Akeeba\\UsageStats\\Collector\\' => 
        array (
            0 => __DIR__ . '/..' . '/akeeba/stats_collector/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit736b3145a8ce3e551e2a494a8a58966e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit736b3145a8ce3e551e2a494a8a58966e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit736b3145a8ce3e551e2a494a8a58966e::$classMap;

        }, null, ClassLoader::class);
    }
}