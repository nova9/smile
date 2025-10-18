<?php

namespace App\Services;

class Profile
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getProfilePictureUrl($user)
    {
        $profilePictureId = $user->getCustomAttribute('profile_picture');
        return FileManager::getTemporaryUrl($profilePictureId);
    }
}
