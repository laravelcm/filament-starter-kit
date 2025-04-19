<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureUrl();
        $this->configureModels();
    }

    private function configureModels(): void
    {
        Model::automaticallyEagerLoadRelationships();

        Model::unguard();

        Model::shouldBeStrict();
    }

    private function configureUrl(): void
    {
        URL::forceScheme('https');
    }
}
