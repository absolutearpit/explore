<?php

namespace App\Http\Middleware;

use Closure;

class UrlChange
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
        $url = $request->url();
        $this->getUrl($url);

        return $next($request);
    }

    public function getUrl($url){
  
    }

}