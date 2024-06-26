<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcfdb79b3161cca532bdaefc1d0b65af6
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'AWEFOOT\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'AWEFOOT\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'AWEFOOT\\Awesome_Footnotes' => __DIR__ . '/../..' . '/classes/class-awsome-footnotes.php',
        'AWEFOOT\\Controllers\\Footnotes_Formatter' => __DIR__ . '/../..' . '/classes/controllers/class-footnotes-formatter.php',
        'AWEFOOT\\Helpers\\Context_Helper' => __DIR__ . '/../..' . '/classes/helpers/class-context-helper.php',
        'AWEFOOT\\Helpers\\Settings' => __DIR__ . '/../..' . '/classes/helpers/class-settings.php',
     );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcfdb79b3161cca532bdaefc1d0b65af6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcfdb79b3161cca532bdaefc1d0b65af6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcfdb79b3161cca532bdaefc1d0b65af6::$classMap;

        }, null, ClassLoader::class);
    }
}
