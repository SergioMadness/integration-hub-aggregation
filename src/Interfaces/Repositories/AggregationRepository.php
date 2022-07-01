<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\Repositories;

use professionalweb\lms\Common\Interfaces\Repositories\Repository;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Models\db\Aggregation;

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
     * @param bool   $autoCreate
     *
     * @return Aggregation
     */
    public function aggregate(string $namespace, string $id, array $data, bool $autoCreate = false): ?Aggregation;

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