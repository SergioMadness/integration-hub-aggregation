<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Listeners;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Events\EventToProcess;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\GetItemSubsystem;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\AggregationSubsystem;

class AggregationListener
{
    /**
     * @param EventToProcess $eventToProcess
     *
     * @return EventData
     */
    public function handle(EventToProcess $eventToProcess): EventData
    {
        if ($eventToProcess->getProcessOptions()->getSubsystemId() === GetItemSubsystem::GET_AGGREGATED_ITEM_SUBSYSTEM) {
            return app(GetItemSubsystem::class)->setProcessOptions($eventToProcess->getProcessOptions())->process($eventToProcess->getEventData());
        }

        if ($eventToProcess->getProcessOptions()->getSubsystemId() === AggregationSubsystem::AGGREGATION_SUBSYSTEM) {
            return app(AggregationSubsystem::class)->setProcessOptions($eventToProcess->getProcessOptions())->process($eventToProcess->getEventData());
        }

        return $eventToProcess->getEventData();
    }
}