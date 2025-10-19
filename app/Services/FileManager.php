<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    public static function store($file) {
        // Store in public disk so files are directly accessible
        $filePath = $file->store('files', 'public');
        return File::query()->create(['name' => $filePath]);
    }

    public static function getTemporaryUrl(?int $fileId): ?string {
        if (!$fileId) {
            return null;
        }
        $file = File::query()->find($fileId);
        
        if (!$file) {
            return null;
        }
        
        // Use public URL for local storage (works immediately)
        return Storage::disk('public')->url($file->name);
    }
}
