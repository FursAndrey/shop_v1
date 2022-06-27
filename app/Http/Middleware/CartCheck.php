<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;

class CartCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $order = session('order');
        if (is_null($order)) {
            session()->flash('warning', __('cartMiddle.not_exist_order'));
            session()->flush('order');
            return redirect()->route('ind_1');
        }

        if (count($order->skus) == 0) {
            session()->flash('warning', __('cartMiddle.empty_basket'));
            session()->flush('order');
            return redirect()->route('ind_1');
        }

        return $next($request);
    }
}
