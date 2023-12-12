<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use App\Models\User\User;

class Language
{
    protected ?Application $app = null;
    protected ?Request $request = null;
    protected ?User $user = null;
    protected ?String $headerLanguage = null;
    protected ?String $language = null;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
        $this->user = auth()->user();
        $this->headerLanguage = $this->request->header('Accept-Language', null);
        $this->language = $this->user?->language ?: (in_array($this->headerLanguage, User::$langs) 
                                                        ? $this->headerLanguage
                                                        : User::$default_language);
    }

    public function __destruct()
    {
        $this->app = null;
        $this->request = null;
        $this->user = null;
        $this->headerLanguage = null;
        $this->language = null;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->app->getLocale() != $this->language):
            $this->app->setLocale($this->language);
        endif;

        return $next($request);
    }
}