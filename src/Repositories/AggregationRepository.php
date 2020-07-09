<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Repositories;

use professionalweb\IntegrationHub\IntegrationHubDB\Repositories\BaseRepository;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Models\db\Aggregation;
use professionalweb\IntegrationHub\IntegrationHubAggregation\Interfaces\Repositories\AggregationRepository as IAggregationRepository;

/**
 * Repository to work with aggregations
 * @package professionalweb\IntegrationHub\IntegrationHubAggregation\Repositories
 */
class AggregationRepository extends BaseRepository implements IAggregationRepository
{
    public function __construct()
    {
        $this->setModelClass(Aggregation::class);
    }

    /**
     * Aggregate and save data
     *
     * @param string $namespace
     * @param string $id
     * @param array  $data
     *
     * @return Aggregation
     */
    public function aggregate(string $namespace, string $id, array $data): Aggregation
    {
        return Aggregation::query()->updateOrCreate([
            'namespace' => $namespace,
            'item_id'   => $id,
        ], [
            'data' => $data,
        ]);
    }

    /**
     * Get data by namespace and id
     *
     * @param string $namespace
     * @param string $id
     *
     * @return array|null
     */
    public function getData(string $namespace, string $id): ?array
    {
        /** @var Aggregation $model */
        $model = Aggregation::query()->where('namespace', $namespace)->where('item_id', $id)->first();

        return $model !== null ? $model->data : [];
    }
}
