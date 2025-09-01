<?php

namespace App\Livewire\Common;

use App\Models\File;
use App\Services\FileManager;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class UserNav extends Component
{
    public $profilePicture;

    public function mount()
    {
        $profilePictureId = auth()->user()->getCustomAttribute('profile_picture');
        $this->profilePicture = FileManager::getTemporaryUrl($profilePictureId);
    }

    public function render()
    {
        return view('livewire.common.user-nav');
    }
}
