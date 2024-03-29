<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcfb59d5f1de052914d50d5c00d535406
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'FCFeedback\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'FCFeedback\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcfb59d5f1de052914d50d5c00d535406::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcfb59d5f1de052914d50d5c00d535406::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcfb59d5f1de052914d50d5c00d535406::$classMap;

        }, null, ClassLoader::class);
    }
}
