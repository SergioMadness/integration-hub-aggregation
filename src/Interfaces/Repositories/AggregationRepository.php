<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\Repositories;

use professionalweb\IntegrationHub\IntegrationHubAggregation\Models\db\Aggregation;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Repositories\Repository;

/**
 * Interface for repository to work with aggregations
 * @package professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\Repositories
 */
interface AggregationRepository extends Repository
{
    /**
     * Aggregate and save data
     *
     * @param string $namespace
     * @param string $id
     * @param array  $data
     *
     * @return Aggregation
     */
    public function aggregate(string $namespace, string $id, array $data): Aggregation;

    /**
     * Get data by namespace and id
     *
     * @param string $namespace
     * @param string $id
     *
     * @return array|null
     */
    public function getData(string $namespace, string $id): ?array;
}