<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Events\EventToProcess;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Listeners\AggregationListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        EventToProcess::class => [
            AggregationListener::class,
        ],
    ];
}
