<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    public static function store($file) {
        $filePath = $file->store(path: 'files');
        return File::query()->create([
            'name' => $filePath,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public static function getTemporaryUrl(?int $fileId): ?string {
        if (!$fileId) {
            return null;
        }
        $file = File::query()->find($fileId);
        return Storage::temporaryUrl($file->name, now()->addMinutes(5));
    }
}
