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
        /** @var Aggregation $model */
        $model = $this->getAggregationRepository()->save(
            $this->getAggregationRepository()->create([
                'item_id' => $eventData->get('id'),
                'group'   => $this->getProcessOptions()->getOptions()['namespace'],
                'data'    => $eventData->getData(),
            ])
        );

        return $eventData->setData([
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