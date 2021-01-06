<?php

namespace App\Exceptions;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }

        $url = $exception->redirectTo() ?? '';


        if (! $url) {
            // uncomment to allow multi auth guards
            $guard = Arr::get($exception->guards(), 0);

            switch ($guard) {
                case 'web_admin':
                    $url = with(new User)->loginUrl();
                    break;

                default:
                    $url = '/login';
                    break;
            }
        }

        return redirect()->guest($url);
    }
}
