<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $roleRoutes = [
            'requester' => '/requester/dashboard/profile',
            'volunteer' => '/volunteer/dashboard/profile',
            'lawyer' => '/lawyer/dashboard/profile',
            'admin' => '/admin/dashboard/profile',
        ];

        $role = auth()->user()->role->name;


        $route = $roleRoutes[$role] ?? '/profile';

        return redirect($route);
    }
    
    public function changeEmail(string $new_email){
        
        auth()->user()->update([
            'email' => base64_decode($new_email)
        ]);
        session()->flash('message','Successfully changed the emalil');
        return redirect('/');
        
    }
}
