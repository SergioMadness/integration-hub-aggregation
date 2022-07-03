<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Models\AggregationOptions;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\GetItemSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\SubsystemPool;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Services\AggregationSubsystem;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Repositories\AggregationRepository;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Services\GetAggregatedItemSubsystem;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\AggregationSubsystem as IAggregationSubsystem;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\Repositories\AggregationRepository as IAggregationRepository;

class IntegrationHubAggregationProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'IntegrationHubAggregation');

        $this->app->booted(static function () {
            /** @var SubsystemPool $pool */
            $pool = app(SubsystemPool::class);
            $pool->register(trans('IntegrationHubAggregation::common.name'), AggregationSubsystem::AGGREGATION_SUBSYSTEM, new AggregationOptions());
        });
    }

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);

        $this->app->bind(IAggregationSubsystem::class, AggregationSubsystem::class);
        $this->app->bind(GetItemSubsystem::class, GetAggregatedItemSubsystem::class);
        $this->app->bind(IAggregationRepository::class, AggregationRepository::class);
    }
}