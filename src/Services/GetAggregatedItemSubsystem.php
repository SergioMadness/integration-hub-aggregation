<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Models\GetItemOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\GetItemSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

/**
 * Subsystem to get item by id and namespace
 * @package professionalweb\IntegrationHub\IntegrationHubAggregation\Services
 */
class GetAggregatedItemSubsystem implements GetItemSubsystem
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
        return new GetItemOptions();
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
