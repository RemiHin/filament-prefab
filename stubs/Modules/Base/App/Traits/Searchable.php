<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Scout\Searchable as ScoutSearchable;
use App\Contracts\IsSearchable;

/**
 * @used-by Model
 * @used-by IsSearchable;
 */
trait Searchable
{
    use ScoutSearchable;

    public function toSearchable(): array
    {
        return [
            'title' => $this->getName(),
            'slug' => $this->getRoute(),
            'type' => self::getResourceName(),
        ];
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        // If a property is a module, map module settings
        $config = collect(config('searchable.models.' . static::class))->mapWithKeys(function ($property, $key) {
            if (is_string($property) && config("searchable.modules.{$property}") && $this->isRelation($property)) {
                return [$property => config("searchable.modules.{$property}")];
            }

            return [$key => $property];
        })
            ->toArray();

        return $this->mapSearchableArray($this, $config);
    }

    /**
     * Recursively map nested properties.
     *
     * @param Model|Collection $item
     * @param array|string $config
     * @return array
     */
    protected function mapSearchableArray($item, $config): array
    {
        $fields = collect($config)->filter(fn ($value, $key) => ! is_array($value));
        $relations = collect($config)->filter(fn ($value, $key) => is_array($value));

        $relationsArray = [];

        foreach ($relations as $relation => $relationConfig) {
            $relationValue = $item->$relation()
                ->scopes($item->$relation()->getModel()::$frontendScopes ?? [])
                ->get();

            if ($relationValue instanceof Model) {
                $relationsArray[$relation] = $this->mapSearchableArray($relationValue, $relationConfig);
            } elseif ($relationValue instanceof Collection) {
                $relationsArray[$relation] = [];
                foreach ($relationValue as $key => $nestedModel) {
                    $relationsArray[$relation][$key] = $this->mapSearchableArray($nestedModel, $relationConfig);
                }
            }
        }

        return array_merge(
            collect($item->attributesToArray())->only($fields)->toArray(),
            $relationsArray,
        );
    }
}
