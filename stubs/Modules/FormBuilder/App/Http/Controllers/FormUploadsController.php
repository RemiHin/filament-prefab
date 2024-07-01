<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FormUploadsController extends Controller
{
    public function download(string $path): StreamedResponse
    {
        return Storage::disk('form_uploads')->download($path);
    }
}
