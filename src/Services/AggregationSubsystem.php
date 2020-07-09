<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Models\AggregationOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\AggregationSubsystem as IAggregationSubsystem;

class AggregationSubsystem implements IAggregationSubsystem
{
    /**
     * @var ProcessOptions
     */
    private $processOptions;

    /**
     * Set options with values
     *
     * @param ProcessOptions $options
     *
     * @return Subsystem
     */
    public function setProcessOptions(ProcessOptions $options): Subsystem
    {
        $this->processOptions = $options;

        return $this;
    }

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new AggregationOptions();
    }

    /**
     * Process event data
     *
     * @param EventData $eventData
     *
     * @return EventData
     */
    public function process(EventData $eventData): EventData
    {
        // TODO: Implement process() method.
    }

    /**
     * @return ProcessOptions
     */
    public function getProcessOptions(): ProcessOptions
    {
        return $this->processOptions;
    }
}
