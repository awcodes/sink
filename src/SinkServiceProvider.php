<?php

namespace Awcodes\Sink;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SinkServiceProvider extends PackageServiceProvider
{
    public static string $name = 'sink';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasTranslations()
            ->hasViews();
    }
}
