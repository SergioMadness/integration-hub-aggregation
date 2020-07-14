<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Repositories;

use Illuminate\Support\Carbon;
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
        /** @var Aggregation $model */
        $model = Aggregation::query()->firstOrNew([
            'group'   => $namespace,
            'item_id' => $id,
        ], [
            'data' => $data,
        ]);

        $model->data = array_merge($model->data, $data);
        $model->save();

        return $model;
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
        $model = Aggregation::query()->where('group', $namespace)->where('item_id', $id)->first();

        return $model !== null ? $model->data : [];
    }

    /**
     * Get last item date
     *
     * @param string $namespace
     *
     * @return Carbon
     */
    public function getLastItemDate(string $namespace): ?Carbon
    {
        /** @var Aggregation $model */
        $model = Aggregation::query()->where('group', $namespace)->select(['updated_at'])->orderBy('updated_at', 'desc')->first();

        return $model !== null ? $model->updated_at : null;
    }
}
