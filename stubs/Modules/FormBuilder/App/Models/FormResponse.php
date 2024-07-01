<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormResponse extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'response_number' => 'int',
        'form_data' => 'array',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function getRespondentName(): ?string
    {
        if (! $this->form->inform_respondent) {
            return null;
        }

        if ($id = $this->form->respondent_name_field) {
            return $this->form_data[$id]['answer'];
        }

        return null;
    }

    public function getRespondentEmail(): ?string
    {
        if (! $this->form->inform_respondent) {
            return null;
        }

        if ($id = $this->form->respondent_email_field) {
            return $this->form_data[$id]['answer'];
        }

        return null;
    }

    public function getRoute(): string
    {
        url('admin/form-builders');
    }
}
