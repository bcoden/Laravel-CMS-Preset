<?php

namespace Bcoden\Laravel\Presets;

use Illuminate\Foundation\Console\PresetCommand as LaravelPreset;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

class Preset extends LaravelPreset
{
    public static function install() {
        static::updatePackages();
        static::updateMix();
        static::updateBootstap();
    }

    /*
     * Clean up less directory
     */
    public static function cleanSassDirectory() {
        File::cleanDirectory(resource_path('assets/less'));
    }

    // set up sass

    /**
     * Updates default npm packages
     *
     * @param $packages
     * @return array
     */
    public static function updatePackages($packages) {
        $include = ['laravel-mix-tailwind' => '0.1.0', 'node-sass' => '^4.12.0'];
        $exclude = ['popper.js', 'lodash', 'jquery'];

        return array_merge($include, Arr::except($packages, $exclude));
    }

    /**
     * Move the webpack mix configuration
     */
    public static function updateMix() {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Sets up bootstrap js the way we like it
     */
    public static function updateBootstap() {
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('assets/js/bootstrap.js'));
    }
}