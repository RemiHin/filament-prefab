<?php

namespace App\Http\Middleware;

use App\Enums\RedirectType;
use App\Models\Redirect;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\Response;

class RedirectsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = '/' . ltrim($request->path(), '/');

        if ($redirectResponse = $this->handleRedirect($path)) {
            return $redirectResponse;
        }

        return $next($request);
    }

    protected function handleRedirect(string $path): RedirectResponse|Redirector|null
    {
        $redirect = Redirect::query()->firstWhere('request_path', $path);

        if (! $redirect) {
            return null;
        }

        return redirect($redirect->target_path, $redirect->redirect_type === RedirectType::PERMANENT->value ? 301 : 302);
    }
}
