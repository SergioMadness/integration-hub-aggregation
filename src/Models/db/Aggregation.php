<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Models\db;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Model to work with aggregations
 * @package professionalweb\IntegrationHub\IntegrationHubAggregation\Models\db
 *
 * @property string        $id
 * @property string        $item_id
 * @property string        $group
 * @property array         $data
 * @property string|Carbon $created_at
 * @property string|Carbon $updated_at
 */
class Aggregation extends Model
{
    protected $table = 'aggregation';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $casts = [
        'data' => 'json',
    ];

    protected $fillable = [
        'item_id',
        'group',
        'data',
    ];

    /**
     * Get data by name
     *
     * @param string $name
     * @param        $default
     *
     * @return mixed
     */
    public function getDataItem(string $name, $default)
    {
        return $this->data[$name] ?? $default;
    }
}