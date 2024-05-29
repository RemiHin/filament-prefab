<?php

namespace App\Livewire;

use App\Models\Education;
use App\Models\Location;
use App\Models\Position;
use App\Models\Vacancy;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class VacancySearch extends Component
{
    use WithPagination;

    public ?string $term = null;

    public array $positions = [];

    public array $educations = [];

    public array $locations = [];

    public int $hoursMin = 0;

    public int $hoursMax = 40;

    protected $queryString = [
        'term' => ['except' => ''],
        'positions' => ['except' => []],
        'educations' => ['except' => []],
        'locations' => ['except' => []],
        'hoursMin' => ['except' => 0],
        'hoursMax' => ['except' => 40],
    ];

    public function mount(): void
    {
        $this->restoreFiltersFromSession();
    }

    public function render()
    {
        return view('livewire.vacancy-search');
    }

    protected function restoreFiltersFromSession(): void
    {
        if (! request()->has('term') && Session::has('vacancy.search.term')) {
            $this->term = Session::get('vacancy.search.term', null);
        }

        if (! request()->has('positions') && Session::has('vacancy.search.positions')) {
            $this->positions = Session::get('vacancy.search.positions', []);
        }

        if (! request()->has('educations') && Session::has('vacancy.search.educations')) {
            $this->educations = Session::get('vacancy.search.educations', []);
        }

        if (! request()->has('locations') && Session::has('vacancy.search.locations')) {
            $this->locations = Session::get('vacancy.search.locations', []);
        }

        if (! request()->has('hoursMin') && Session::has('vacancy.search.hoursMin')) {
            $this->hoursMin = Session::get('vacancy.search.hoursMin', 0);
        }

        if (! request()->has('hoursMax') && Session::has('vacancy.search.hoursMax')) {
            $this->hoursMax = Session::get('vacancy.search.hoursMax', 40);
        }
    }

    public function getPositions(): Collection
    {
        return Position::query()
            ->whereHas('vacancies', function (Builder $builder) {
                $builder->visible()
                    ->published();
            })
            ->get();
    }

    public function getEducations(): Collection
    {
        return Education::query()
            ->whereHas('vacancies', function (Builder $builder) {
                $builder->visible()
                    ->published();
            })
            ->get();
    }

    public function getLocations(): Collection
    {
        return Location::query()
            ->whereHas('vacancies', function (Builder $builder) {
                $builder->visible()
                    ->published();
            })
            ->get();
    }

    public function getFilterPositions(): Collection
    {
        if (empty($this->positions)) {
            return collect();
        }

        return Position::query()
            ->whereIn('id', $this->positions)
            ->get();
    }

    public function getFilterEducations(): Collection
    {
        if (empty($this->educations)) {
            return collect();
        }

        return Education::query()
            ->whereIn('id', $this->educations)
            ->get();
    }

    public function getFilterLocations(): Collection
    {
        if (empty($this->locations)) {
            return collect();
        }

        return Location::query()
            ->whereIn('id', $this->locations)
            ->get();
    }

    public function hasFilters(): bool
    {
        if (
            ! empty($this->query)
            || ! empty($this->positions)
            || ! empty($this->educations)
            || ! empty($this->locations)
            || $this->hoursMin > 0
            || $this->hoursMax < 40
        ) {
            return true;
        }

        return false;
    }

    public function resetFilters(): void
    {
        $this->term = null;
        $this->positions = [];
        $this->educations = [];
        $this->locations = [];
        $this->hoursMin = 0;
        $this->hoursMax = 40;

        $this->updateSlider();
        $this->updateSession();
    }

    public function updatedHoursMin(): void
    {
        $this->updateSlider();
    }

    public function updatedHoursMax(): void
    {
        $this->updateSlider();
    }

    protected function updateSlider(): void
    {
        $this->dispatch('updated-slider', $this->hoursMin, $this->hoursMax);
    }

    public function updated(): void
    {
        $this->resetPage();

        $this->updateSession();
    }

    protected function updateSession(): void
    {
        Session::put([
            'vacancy.search' => [
                'term' => $this->term,
                'positions' => $this->positions,
                'educations' => $this->educations,
                'locations' => $this->locations,
                'hoursMin' => $this->hoursMin,
                'hoursMax' => $this->hoursMax,
            ],
        ]);
    }

    public function getVacancies(): LengthAwarePaginator
    {
        return Vacancy::query()
            ->visible()
            ->published()
            ->when(count($this->positions), fn (Builder $query) => $query->whereIn('position_id', $this->positions))
            ->when(count($this->locations), fn (Builder $query) => $query->whereIn('location_id', $this->locations))
            ->when(count($this->educations), function (Builder $query) {
                $query->whereHas('educations', fn (Builder $query) => $query->whereIn('educations.id', $this->educations));
            })
            ->when(! empty($this->term), function (Builder $query) {
                $query->where(function (Builder $where) {
                    $where->orWhere('name', 'LIKE', "%{$this->term}%");
                    $where->orWhere('meta->value', 'LIKE', "%{$this->term}%");
                    $where->orWhere('content', 'LIKE', "%{$this->term}%");
                });
            })
            ->when($this->hoursMin > 0, function (Builder $query) {
                $query->hoursMin($this->hoursMin);
            })
            ->when($this->hoursMax < 40, function (Builder $query) {
                $query->hoursMax($this->hoursMax);
            })
            ->latest('created_at')
            ->with([
                'position',
                'educations',
                'location',
            ])
            ->paginate(10)
            ->setPath('/vacatures');
    }

    public function paginationView()
    {
        return 'components.pagination.simple';
    }

    public function paginationSimpleView()
    {
        return 'components.pagination.simple';
    }
}
