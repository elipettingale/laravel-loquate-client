<?php

namespace EliPett\LoquateClient;

use Illuminate\Support\ServiceProvider;

class LoquateClientServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslations();
        $this->publishAssets();
    }

    private function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/Resources/lang', 'loquateclient');
    }

    private function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/../config/loquateclient.php' => config_path('loquateclient.php'),
        ], 'config');
    }
}
