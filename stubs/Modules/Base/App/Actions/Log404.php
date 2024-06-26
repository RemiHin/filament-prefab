<?php

namespace App\Actions;

use Exception;
use App\Models\NotFoundLog;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Log404
{
    public function handle(Exception $exception): void
    {
        if ($exception instanceof NotFoundHttpException) {
            $latest = NotFoundLog::query()->firstWhere('path', request()->fullUrl());
            $count = $latest?->count ? $latest->count + 1 : 1;

            NotFoundLog::query()
                ->updateOrCreate([
                    'path' => request()->fullUrl(),
                ], [
                    'latest_occurrence' => now(),
                    'count' => $count,
                ]);
        }
    }
}
