<?php

namespace App\Http\Middleware;

use Closure;
use App\Contact;

class CheckIdUserAuthenticated
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
        $contact = Contact::find($request->id);
        if( $contact->user_id !== auth()->user()->id ){
            abort('401', 'Este contato não corresponde ao seu usuário');
        }
        return $next($request);
    }
}
