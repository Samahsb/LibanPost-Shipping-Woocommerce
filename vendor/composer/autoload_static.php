<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite0701f1d9279eb4be50773ac7cb60f24
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Picqer\\Barcode\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Picqer\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/picqer/php-barcode-generator/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite0701f1d9279eb4be50773ac7cb60f24::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite0701f1d9279eb4be50773ac7cb60f24::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite0701f1d9279eb4be50773ac7cb60f24::$classMap;

        }, null, ClassLoader::class);
    }
}
