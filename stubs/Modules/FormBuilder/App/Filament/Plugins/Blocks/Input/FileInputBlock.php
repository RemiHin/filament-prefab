<?php

namespace App\Filament\Plugins\Blocks\Input;

use App\Filament\Plugins\FormBlock;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileInputBlock extends FormBlock
{
    public static function getType(): string
    {
        return 'input-file';
    }

    public static function getLabel(): string
    {
        return __('File');
    }

    public static function getFields(): array
    {
        return [
            TextInput::make('file')
                ->label(__('Title'))
                ->required(),

            Toggle::make('required')
                ->label(__('Required'))
                ->default(true),

            TextInput::make('allowed_mime_types')
                ->label(__('Allowed file types'))
                ->helperText(__('Define the allowed file types, comma seperated (e.g. pdf,doc,docx)'))
                ->nullable(),

            TextInput::make('max_file_size')
                ->label(__('Maximum file size (kb)'))
                ->numeric()
                ->nullable(),

            Textarea::make('comment')
                ->label(__('File comment'))
                ->nullable(),
        ];
    }

    public static function factory(): ?array
    {
        return null;
    }

    public function getRules(): array
    {
        $rules = [
            'file' => [
                $this->required ? 'required' : 'nullable',
                'file',
            ],
        ];

        if ($this->allowed_mime_types) {
            $rules['file'][] = 'mimes:' . strtolower(str_replace(' ', '', $this->allowed_mime_types));
        }

        if ($this->max_file_size) {
            $rules['file'][] = 'max:' . $this->max_file_size;
        }

        return $rules;
    }

    public function getAttributes(): array
    {
        return [
            'file' => strtolower($this->title),
        ];
    }

    public function getQuestion(): string
    {
        return $this->file;
    }

    public function getAnswer(array $data): ?string
    {
        if (array_key_exists('file', $data) && $data['file'] instanceof UploadedFile) {
            return Storage::disk('form_uploads')->putFile($data['file']);
        }

        return null;
    }

    public function getFilamentField(): Field
    {
        return FileUpload::make('form_data.' . $this->id . '.answer')
            ->disk('form_uploads')
            ->visibility('private')
            ->downloadable()
            ->previewable()
            ->deletable(false)
            ->label($this->getQuestion());
    }
}
