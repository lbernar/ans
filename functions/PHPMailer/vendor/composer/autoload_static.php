<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit35ffe5dc256a02c07c2ec39e1df953af
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit35ffe5dc256a02c07c2ec39e1df953af::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit35ffe5dc256a02c07c2ec39e1df953af::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
