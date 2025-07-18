<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $roleRoutes = [
            'requester' => '/requester/dashboard',
            'volunteer' => '/volunteer/dashboard',
            'lawyer' => '/lawyer/dashboard',
            'admin' => '/admin/dashboard',
        ];

        $role = auth()->user()->role->name;


        $route = $roleRoutes[$role] ?? '/dashboard';

        return redirect($route);
    }
}
