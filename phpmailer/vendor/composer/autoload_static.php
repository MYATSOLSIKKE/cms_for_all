<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitca1284094745321e9fd60d2a562c3ab8
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitca1284094745321e9fd60d2a562c3ab8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitca1284094745321e9fd60d2a562c3ab8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitca1284094745321e9fd60d2a562c3ab8::$classMap;

        }, null, ClassLoader::class);
    }
}
