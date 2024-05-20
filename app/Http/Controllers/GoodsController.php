<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;

class GoodsController extends Controller
{
    //
    public function show(string $id)
    {
        return json_encode([
            'goods' => Goods::findOrFail($id)
        ], JSON_UNESCAPED_UNICODE);
    }
}
