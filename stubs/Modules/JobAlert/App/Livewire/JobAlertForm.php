<?php

namespace App\Livewire;

use App\Mail\JobAlert\VerifyJobAlert;
use Livewire\Component;
use App\Models\JobAlert;
use App\Models\Position;
use App\Models\Location;
use App\Models\Education;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;

class JobAlertForm extends Component
{
    public ?string $name = null;

    public ?string $email = null;

    public array $positions = [];

    public array $educations = [];

    public array $locations = [];

    public int $hoursMin = 0;

    public int $hoursMax = 40;

    public bool $submitted = false;

    public bool $updatedPreferences = false;

    public ?JobAlert $jobAlert = null;

    protected array $rules = [
        'name' => [
            'required',
            'max:250',
        ],
        'email' => [
            'required',
            'email',
            'max:250',
        ],
        'hoursMin' => [
            'required',
            'min:0',
            'max:40',
        ],
        'hoursMax' => [
            'required',
            'min:0',
            'max:40',
        ],
        'positions' => [
            'array',
        ],
        'positions.*' => [
            'exists:positions,id',
        ],
        'educations' => [
            'array',
        ],
        'educations.*' => [
            'exists:educations,id',
        ],
        'locations' => [
            'array',
        ],
        'locations.*' => [
            'exists:locations,id',
        ],
    ];

    public function mount(): void
    {
        if ($this->jobAlert) {
            $this->name = $this->jobAlert->name;
            $this->email = $this->jobAlert->email;
            $this->hoursMin = $this->jobAlert->hours_min;
            $this->hoursMax = $this->jobAlert->hours_max;

            $this->positions = $this->jobAlert->positions()->pluck('id')->toArray();
            $this->educations = $this->jobAlert->educations()->pluck('id')->toArray();
            $this->locations = $this->jobAlert->locations()->pluck('id')->toArray();
        }
    }

    public function render(): View
    {
        return view('livewire.job-alert-form');
    }

    public function submit(): void
    {
        if ($this->submitted) {
            return;
        }

        $this->dispatch('job-alert-form.scroll-top');

        $this->validate();

        // Set submitted to true so livewire replaces form with thank you message
        $this->submitted = true;

        // Preferences have been updated when email already exists or a job alert has been giving as a livewire property
        $this->updatedPreferences = $this->jobAlert || JobAlert::query()->where('email', $this->email)->exists();

        $jobAlert = $this->jobAlert;

        // If job alert not set as livewire property, find or create new object
        if (is_null($jobAlert)) {
            $jobAlert = JobAlert::firstOrNew([
                'email' => $this->email,
            ]);
        }

        // Update or create new model
        $jobAlert->email = $this->email;
        $jobAlert->name = $this->name;
        $jobAlert->hours_min = $this->hoursMin;
        $jobAlert->hours_max = $this->hoursMax;
        $jobAlert->save();

        // Delete all existing filters and attach new ones
        $jobAlert->filters()->delete();

        foreach ($this->positions as $positionId)
        {
            $jobAlert->filters()->create([
                'setting_type' => (new Position)->getMorphClass(),
                'setting_id' => $positionId,
            ]);
        }

        foreach ($this->educations as $educationId)
        {
            $jobAlert->filters()->create([
                'setting_type' => (new Education)->getMorphClass(),
                'setting_id' => $educationId,
            ]);
        }

        foreach ($this->locations as $locationId)
        {
            $jobAlert->filters()->create([
                'setting_type' => (new Location)->getMorphClass(),
                'setting_id' => $locationId,
            ]);
        }

        // Send verify email if not yet verified
        if (is_null($jobAlert->email_verified_at)) {
            $this->sendVerifyEmail($jobAlert);
        }
    }

    protected function sendVerifyEmail(JobAlert $jobAlert): void
    {
        Mail::to($jobAlert)->queue(new VerifyJobAlert($jobAlert));
    }
}
