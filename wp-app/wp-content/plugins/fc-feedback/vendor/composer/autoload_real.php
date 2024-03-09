<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitcfb59d5f1de052914d50d5c00d535406
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitcfb59d5f1de052914d50d5c00d535406', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitcfb59d5f1de052914d50d5c00d535406', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitcfb59d5f1de052914d50d5c00d535406::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
