<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8ad864412dfd0bcfd86859ad15078cf8
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Marianamadrid\\BusesSabana\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Marianamadrid\\BusesSabana\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit8ad864412dfd0bcfd86859ad15078cf8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8ad864412dfd0bcfd86859ad15078cf8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8ad864412dfd0bcfd86859ad15078cf8::$classMap;

        }, null, ClassLoader::class);
    }
}
