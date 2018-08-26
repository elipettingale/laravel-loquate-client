<?php

namespace EliPett\LoquateClient;

use Illuminate\Support\ServiceProvider;

class LoquateClientServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishAssets();
    }

    private function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/../config/loquateclient.php' => config_path('loquateclient.php'),
        ], 'config');
    }
}
