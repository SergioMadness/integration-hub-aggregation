<?php namespace professionalweb\IntegrationHub\IntegrationHubAggregation\Models;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

/**
 * Options for aggregation subsystem
 * @package professionalweb\IntegrationHub\IntegrationHubAggregation\Models
 */
class AggregationOptions implements SubsystemOptions
{

    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'id' => 'Id',
        ];
    }

    /**
     * Get array fields, that subsystem generates
     *
     * @return array
     */
    public function getAvailableOutFields(): array
    {
        return [];
    }

    /**
     * Get service settings
     *
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'namespace' => [
                'name' => 'Namespace',
                'type' => 'string',
            ],
        ];
    }
}