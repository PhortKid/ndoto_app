<?php
/*
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'buyer_phone' => 'required|string',
            'buyer_network' => 'nullable|string',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $orderData = [
            'create_order' => 1,
            'buyer_phone' => $validated['buyer_phone'],
            'buyer_name' => 'username',
            'buyer_email' => 'email@gmail.com',
            'amount' => $validated['amount'],
            'account_id' => env('ZENO_ACCOUNT_ID', 'zp86069'),
            'api_key' => env('ZENO_API_KEY'),
            'secret_key' => env('ZENO_SECRET_KEY'),
        ];

        $response = Http::asForm()->post('https://api.zeno.africa', $orderData);

        return response()->json($response->json(), $response->status());
    }
}
*/

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        // Manual validator
        $validator = Validator::make($request->all(), [
            'buyer_phone' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        // If validation fails, return JSON error
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $orderData = [
            'create_order' => 1,
            'buyer_phone' => $request->buyer_phone,
            'buyer_name' => 'username',
            'buyer_email' => 'email@gmail.com',
            'amount' => $request->amount,
            'account_id' => env('ZENO_ACCOUNT_ID', 'zp86069'),
            'api_key' => env('ZENO_API_KEY'),
            'secret_key' => env('ZENO_SECRET_KEY'),
        ];

        $response = Http::asForm()->post('https://api.zeno.africa', $orderData);

        return response()->json($response->json(), $response->status());
    }


    //get order data

    public function checkOrderStatus(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Prepare payload
        $postData = [
            'check_status' => 1,
            'order_id' => $request->order_id,
            'api_key' => env('ZENO_API_KEY'),
            'secret_key' => env('ZENO_SECRET_KEY'),
        ];

        // Send POST request to Zeno
        $response = Http::asForm()->post('https://api.zeno.africa/order-status', $postData);

        return response()->json($response->json(), $response->status());
    }
}
