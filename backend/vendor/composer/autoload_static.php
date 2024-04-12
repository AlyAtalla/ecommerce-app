<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3b946d533eeec4f4151bf398e0fb0653
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GraphQL\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GraphQL\\' => 
        array (
            0 => __DIR__ . '/..' . '/webonyx/graphql-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3b946d533eeec4f4151bf398e0fb0653::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3b946d533eeec4f4151bf398e0fb0653::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3b946d533eeec4f4151bf398e0fb0653::$classMap;

        }, null, ClassLoader::class);
    }
}
