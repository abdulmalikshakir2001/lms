<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */

    public function render($request, Throwable $exception)
    {
        // Check for Spatie's UnauthorizedException
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
        // Flash a permission denied error message to the session
        return redirect()->back()->with('error', 'Permission Denied!');
        }

        // Optionally, handle default 403 errors
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException && $exception->getStatusCode() == 403) {
        return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }

        return parent::render($request, $exception);
    }

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
