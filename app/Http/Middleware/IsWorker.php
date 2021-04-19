<?php
  
namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
   
class IsWorker
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
        
        if (auth()->user('is_worker') == null) {
            return redirect('login')->with('error', "devi loggarti prima");
        }
        elseif(auth()->user()->is_worker == 1){
            return $next($request);
        
        }
        return redirect(‘home’)->with(‘error’,"You don't have worker access.");
    }
}
