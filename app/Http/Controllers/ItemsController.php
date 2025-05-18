<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Models\Item;
class ItemsController extends Controller
{
    public function index()
    {

        $items=Item::all();
        return view('dashboard.items.index',compact('items'));
    }



    public function store(Request $request)
    {


      
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'nullable|numeric|min:1',
            'is_unlimited' => 'nullable',
            'is_active' => 'nullable',
            'profile_image' => 'nullable|max:2048',
        ]);

       // return $request;

        
 



        $workspaceItem = new Item();

        
        $workspaceItem->name = $validatedData['name'];
        $workspaceItem->note = $validatedData['note'] ?? null;
        $workspaceItem->price = $validatedData['price'];
        $workspaceItem->quantity = $request->has('is_unlimited') && $request->is_unlimited ? null : $validatedData['quantity']; // Set quantity to null if unlimited

        $workspaceItem->is_unlimited = $request->has('is_unlimited') && '1';
        $workspaceItem->is_active = $request->has('is_active') && '1';
        $workspaceItem->user_id = Auth()->user()->id;
 

          
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileNameToStore = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('image');
            $file->move($destinationPath, $fileNameToStore);
            $workspaceItem->image = $fileNameToStore;
        } else {
            $workspaceItem->image = "no_image.png";
        }
    


       $workspaceItem->save();

        return redirect()->route('workspace_items.index')->with('success', 'Item successfully added!');
    }


    public function update(Request $request, $id)
    {
      
        $item = Item::findOrFail($id);
    
        
        $item->update([
            'name' => $request->name,
            'note' => $request->note,
            'price' => $request->price
        ]);
    
      
        return redirect()->route('workspace_items.index')->with('success', 'Item Updated');
    }
    


    public function destroy(string $id){

        $item =Item::find($id);
        $item->delete();
        return redirect()->route('workspace_items.index')->with('success','Item Deleted');
    }
}
