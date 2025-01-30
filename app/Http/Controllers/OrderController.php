<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Resources\OrderResource;
use Exception;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addOrder = DB::transaction(function() use ($request) {
            $userId = $request->input('user_id');
            $statusId = $request->input('status_id');

            $order = Order::create([
                'user_id' => $userId,
                'status_id' => $statusId,
                'number' => (string) Str::uuid(),
                'order_date' => Carbon::now()
            ]);
    
            foreach ($request->input('products') as $product) {
                $productInDb = Product::find($product['id']);
                if (!$product || $productInDb->count < $product['count']) {
                    throw new Exception('Error product');
                }
                $productInDb->count -= $product['count'];
                $productInDb->save();
                $productsId[] = $product['id'];
            }
    
            $order->products()->sync($productsId);

            return $order ;
        });
 
        return response()->json(['Order created success', new OrderResource($addOrder)]);
    }
}
