<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Vacancy;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Enums\ApplicantStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApplicationForm extends Component
{
    use WithFileUploads;

    public Vacancy $vacancy;

    public array $formData = [];

    public $cv;

    public bool $success = false;

    public function rules()
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'addition' => [
                'nullable',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'phone:NL,BE',
                'string',
                'max:255',
            ],
            'motivation' => [
                'nullable',
                'string',
                'max:65535',
            ],
        ];
    }

    public function submit()
    {
        $request = $this->formData;
        $attributes = Validator::make($request, $this->rules())->validate();

        if (!empty($this->cv)) {
            Validator::make([
                'cv' => $this->cv,
            ], [
                'cv' => [
                    'nullable',
                    'file',
                    'mimes:doc,docx,pdf,ott',
                ]
            ])->validate();

            $filename = Str::uuid() . '_' . $this->cv->getClientOriginalName();
            Storage::disk('cv')->putFileAs(null, $this->cv, $filename);
            $attributes['cv'] = $filename;
        }

        $attributes['status'] = ApplicantStatus::NEW->value;
        $this->vacancy->applicants()->create($attributes);

        $this->clearForm();
        $this->success = true;
    }

    public function clearForm()
    {
        $this->formData = [];
        $this->cv = '';
    }

    public function render(): View
    {
        return view('livewire.application-form');
    }
}
