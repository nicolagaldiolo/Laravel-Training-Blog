<?php

namespace App\Http\Middleware;

use Closure;

class Language
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

        // ci assicuriamo che la locale esiste
        // blog.dev/it/posts
        // blog.dev = [0]
        // it = [1]
        // posts = [2]
        $locale = $request->segment(1);

        // se non esiste mettiamo quella di default e reindirizziamo

        // controlliamo le locales supportate
        if(!in_array($locale, config('app.locales'))){

            //prendiamo tutti i segmenti dell'url
            $segments = $request->segments();

            //impsotiamo il elemento come il fallback
            $segments[0] = config('app.fallback_locale');

            // reindirizzo ad un url con una locale valida

            return redirect(implode('/', $segments));
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
