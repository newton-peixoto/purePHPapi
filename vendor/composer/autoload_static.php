<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite9910c74ea5a4f3aef9ab7493d7df16b
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite9910c74ea5a4f3aef9ab7493d7df16b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite9910c74ea5a4f3aef9ab7493d7df16b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
