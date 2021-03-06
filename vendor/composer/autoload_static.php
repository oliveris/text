<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitadf5b733b6f0e714f20a2f8e976974fe
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
            'Text\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/Twilio',
        ),
        'Text\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Text',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitadf5b733b6f0e714f20a2f8e976974fe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitadf5b733b6f0e714f20a2f8e976974fe::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
