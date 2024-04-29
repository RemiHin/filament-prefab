<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Elastic\Elasticsearch\Exception\ClientResponseException;

class SearchController extends Controller
{
    public function search(Request $request): View
    {
        $results = null;

        if ($query = $request->input('query')) {
            $results = $this->getSearchResults($query);
        }

        return view('resources.page.search', [
            'results' => $results,
        ]);
    }

    protected function getSearchResults(string $query): Collection
    {
        $searchResults = collect();

        foreach (config('searchable.models') as $model => $config) {
            try {
                /** @var Collection $searchResult */
                $searchResult = $model::search("*{$query}*")
                    ->get()
                    ->map(fn($model) => $model->toSearchable());

                $searchResults->push(...$searchResult);
            } catch (ClientResponseException $exception) {
                report($exception);
            }
        }

        return $searchResults;
    }
}
