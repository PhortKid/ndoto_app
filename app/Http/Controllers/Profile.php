<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile extends Controller
{
    
    public function index(){
        $user = auth()->user();
        $totalItems = $user->items()->count();
        return view('dashboard.profile', compact('totalItems'));
    }


    public function update(Request $request,$profile)
    {
        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = $path; // Update the avatar field for the profile
        }

        $profile->email_notifications = $request->has('email_notifications');
        $profile->item_updates = $request->has('item_updates'); 
        $profile->security_alerts = $request->has('security_alerts');
        $profile->save();

        return back()->with('success', 'Profile updated successfully');
    }
    public function destroy()
    {
        $user = auth()->user();
        $user->delete();
        
        return redirect('/')->with('success', 'Account deleted successfully');
    }
}
