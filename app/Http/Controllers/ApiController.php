<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getSkus()
    {
        $skus = Sku::with('product')->available()->get()->append('product_info');

        return response()->json($skus);
    }
}
