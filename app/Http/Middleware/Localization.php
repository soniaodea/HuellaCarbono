<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;


class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has("locale")) {
            $lang = Session::get("locale");
        } else {
            // check browser lang - https://learninglaravel.net/detect-and-change-language-on-the-fly-with-laravel
            $lang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

            if ($lang != 'es' && $lang != 'eu' && $lang != 'en') {
                $lang = 'eu';
            }
        }

        App::setLocale($lang);
        return $next($request);
    }
}
