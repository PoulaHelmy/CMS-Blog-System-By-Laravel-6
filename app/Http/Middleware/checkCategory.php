<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

use MongoDB\Driver\Session;

class checkCategory
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
        $count=Category::all()->count();
        if($count==0){
            Session()->flash('error','First You Need to Add Some Categories');
            return redirect(route('categories.index'));
        }
        return $next($request);
    }
}
