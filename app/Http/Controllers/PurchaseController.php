<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        return view('purchase_item', compact('item'));
    }

    public function store(Request $request, Item $item)
    {
        // Validate the request
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'is_anonymous' => 'boolean',
            'message' => 'nullable|string|max:1000',
        ]);

        // Check if item is available
        if ($item->is_active != '1') {
            return back()->with('error', 'This item is no longer available.');
        }

        // Check if quantity is available
        if ($item->is_unlimited != '1' && $item->quantity < $validated['quantity']) {
            return back()->with('error', 'Not enough items available.');
        }

        // Create the purchase
        $purchase = Purchase::create([
            'item_id' => $item->id,
            'username' => $validated['username'],
            'is_anonymous' => $request->has('is_anonymous') ? '1' : '0',
            'quantity' => $validated['quantity'],
            'price' => $item->price,
            'message' => $validated['message'] ?? null,
        ]);

        // Update item quantity if not unlimited
        if ($item->is_unlimited != '1') {
            $item->quantity -= $validated['quantity'];
            $item->save();
        }

        // Redirect back with success message
        return redirect()->route('user.show', $item->user->name)
            ->with('success', 'Purchase successful! Thank you for your gift.');
    }
} 