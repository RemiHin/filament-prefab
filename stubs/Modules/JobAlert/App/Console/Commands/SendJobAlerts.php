<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Mail\JobAlert\NewVacanciesFound;
use App\Models\Vacancy;
use App\Models\JobAlert;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class SendJobAlerts extends Command
{
    protected $signature = 'job-alert-vacancies:send';

    protected $description = 'Gather and send vacancies to job alerts';

    public function handle(): int
    {
        $verifiedJobAlerts = JobAlert::verified()->get();
        $sentJobAlertCount = 0;

        /** @var JobAlert $jobAlert */
        foreach ($verifiedJobAlerts as $jobAlert) {
            $vacancyIds = $jobAlert->logs()->pluck('vacancy_id');
            $positions = $jobAlert->positions()->pluck('id');
            $educations = $jobAlert->educations()->pluck('id');
            $locations = $jobAlert->locations()->pluck('id');
            $contractTypes = $jobAlert->contractTypes()->pluck('id');

            $vacancies = Vacancy::query()
                ->visible()
                ->published()
                ->when($vacancyIds->isNotEmpty(), function (Builder $query) use ($vacancyIds) {
                    $query->whereNotIn('id', $vacancyIds);
                })
                ->when($positions->isNotEmpty(), function (Builder $query) use ($positions) {
                    $query->whereIn('position_id', $positions);
                })
                ->when($educations->isNotEmpty(), function (Builder $query) use ($educations) {
                    $query->whereHas('educations', function (Builder $whereHas) use ($educations) {
                        $whereHas->whereIn('educations.id', $educations);
                    });
                })
                ->when($locations->isNotEmpty(), function (Builder $query) use ($locations) {
                    $query->whereIn('location_id', $locations);
                })
                ->when($contractTypes->isNotEmpty(), function (Builder $query) use ($contractTypes) {
                    $query->whereIn('contract_type_id', $contractTypes);
                })
                ->hoursMin($jobAlert->hours_min)
                ->hoursMax($jobAlert->hours_max)
                ->orderByDesc('created_at')
                ->get();

            if ($vacancies->isEmpty()) {
                continue;
            }

            Mail::to($jobAlert)->queue(new NewVacanciesFound($jobAlert, $vacancies));

            $sentJobAlertCount++;

            $jobAlert->logs()->createMany(
                $vacancies->map(fn ($vacancy) => ['vacancy_id' => $vacancy->id])
            );
        }

        $this->info(__(':count job alerts have been sent', ['count' => $sentJobAlertCount]));

        return 0;
    }
}
