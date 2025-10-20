<?php

namespace App\Services;

class Pro
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function numberOfCreatedEventsThisMonth($user)
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        return $user->events()
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();
    }

    public static function isProUser($user)
    {
        return $user->upgrade()->exists();
    }
}
