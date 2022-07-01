<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Models\GetItemOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\GetItemSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Traits\UseAggregationRepository;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\Repositories\AggregationRepository;

/**
 * Subsystem to get item by id and namespace
 * @package professionalweb\IntegrationHub\IntegrationHubAggregation\Services
 */
class GetAggregatedItemSubsystem implements GetItemSubsystem
{
    use UseAggregationRepository;

    /**
     * @var ProcessOptions
     */
    private ProcessOptions $processOptions;

    public function __construct(AggregationRepository $repository)
    {
        $this->setAggregationRepository($repository);
    }

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
        return $eventData->setData(
            $this->getAggregationRepository()->getData(
                $this->getProcessOptions()->getOptions()['namespace'],
                $eventData->get('id')
            )
        );
    }

    /**
     * @return ProcessOptions
     */
    public function getProcessOptions(): ProcessOptions
    {
        return $this->processOptions;
    }
}
