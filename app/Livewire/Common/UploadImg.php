<?php

namespace App\Livewire\Common;

use App\Models\File;
use App\Services\FileManager;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadImg extends Component
{
    use WithFileUploads;
 
    public $photos = [];
 
    public function save()
    {
        foreach ($this->photos as $photo) {
            $photo->store(path: 'photos');
        }
    }
}
