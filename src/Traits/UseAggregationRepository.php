<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Traits;

use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\Repositories\AggregationRepository;

/**
 * Trait for classes use aggregation repository
 * @package professionalweb\IntegrationHub\IntegrationHubAggregation\Traits
 */
trait UseAggregationRepository
{
    /**
     * @var AggregationRepository
     */
    private $aggregationRepository;

    /**
     * @return AggregationRepository
     */
    public function getAggregationRepository(): AggregationRepository
    {
        return $this->aggregationRepository;
    }

    /**
     * @param AggregationRepository $aggregationRepository
     *
     * @return UseAggregationRepository
     */
    public function setAggregationRepository(AggregationRepository $aggregationRepository): self
    {
        $this->aggregationRepository = $aggregationRepository;

        return $this;
    }
}