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
            'requester' => '/requester/profile',
            'volunteer' => '/volunteer/profile',
            'lawyer' => '/lawyer/profile',
            'admin' => '/admin/profile',
        ];

        $role = auth()->user()->role->name;


        $route = $roleRoutes[$role] ?? '/profile';

        return redirect($route);
    }
}
