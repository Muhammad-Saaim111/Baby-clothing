<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class ProfileController extends Controller
{
    /**
     * Show the user profile settings page.
     */
    public function index()
    {
        $user = Auth::user();
        $orderCount = Order::where('user_id', $user->id)->count();

        return view('profile', [
            'user' => $user,
            'orderCount' => $orderCount,
        ]);
    }

    /**
     * Show the user order history page.
     */
    public function orders()
    {
        $user = Auth::user();
        
        $orders = Order::where('user_id', $user->id)
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('orders', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }

    /**
     * Update the user's profile and/or password.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];

        // If it's a normal user trying to change password
        if (!$user->google_id && $request->filled('current_password')) {
            $rules['current_password'] = ['required', 'current_password'];
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }
        
        // If it's a Google user trying to set a password
        if ($user->google_id && $request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $validated = $request->validate($rules);

        // Update name
        $user->name = $validated['name'];

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/avatars');
            
            // Create directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $image->move($destinationPath, $name);
            $user->avatar = '/uploads/avatars/'.$name;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
