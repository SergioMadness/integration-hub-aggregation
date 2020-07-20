<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Models\db\Aggregation;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Models\AggregationOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Traits\UseAggregationRepository;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\Repositories\AggregationRepository;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\AggregationSubsystem as IAggregationSubsystem;

class AggregationSubsystem implements IAggregationSubsystem
{
    use UseAggregationRepository;

    /**
     * @var ProcessOptions
     */
    private $processOptions;

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
        $itemId = $eventData->get('id');
        if (empty($itemId)) {
            return $eventData;
        }
        $namespace = $this->getProcessOptions()->getOptions()['namespace'];

        $repository = $this->getAggregationRepository();
        /** @var Aggregation $model */
        $model = $repository->aggregate($namespace, $itemId, $eventData->getData());

        return $model === null ? $eventData : $eventData->setData([
            'id' => $model->id,
        ]);
    }

    /**
     * @return ProcessOptions
     */
    public function getProcessOptions(): ProcessOptions
    {
        return $this->processOptions;
    }
}