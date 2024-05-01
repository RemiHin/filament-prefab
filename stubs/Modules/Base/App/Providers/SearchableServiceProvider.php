<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class SearchableServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        Event::listen(['eloquent.saved: *', 'eloquent.created: *', 'eloquent.deleted: *'], function(string $key, array $models) {
            foreach ($models as $model) {
                $className = $model::class;

                if (array_key_exists($className, config('searchable.touch'))) {
                    foreach (config("searchable.touch.{$className}", []) as $relationString) {
                        $this->touchRelation($model, explode('.', $relationString));
                    }
                }
            }
        });
    }

    protected function touchRelation(Model $model, array $relations): void
    {
        $relation = array_shift($relations);

        $related = $model->$relation;

        if ($related instanceof Model) {
            $related->touch();

            if (count($relations)) {
                $this->touchRelation($related, $relations);
            }
        } elseif ($related instanceof Collection) {
            foreach ($related as $relatedModel) {
                $relatedModel->touch();

                if (count($relations)) {
                    $this->touchRelation($relatedModel, $relations);
                }
            }
        }
    }
}
