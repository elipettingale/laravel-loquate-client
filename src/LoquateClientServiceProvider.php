<?php

namespace EliPett\LoquateClient;

use EliPett\CodeGeneration\Console\Commands\GenerateController;
use EliPett\CodeGeneration\Console\Commands\GenerateRepository;
use EliPett\CodeGeneration\Console\Commands\GenerateEntity;
use EliPett\CodeGeneration\Console\Commands\GenerateProvider;
use EliPett\CodeGeneration\Console\Commands\GenerateView;
use EliPett\CodeGeneration\Console\RunGenerators;
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
