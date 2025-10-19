<?php

namespace App\Console\Commands;

use App\Models\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MigrateFilesToPublic extends Command
{
    protected $signature = 'files:migrate-to-public';
    protected $description = 'Migrate files from private storage to public storage';

    public function handle()
    {
        $files = File::all();
        $migrated = 0;
        $failed = 0;

        $this->info("Found {$files->count()} files to migrate...");

        foreach ($files as $file) {
            try {
                // Check if file exists in private storage
                if (Storage::exists($file->name)) {
                    // Get the file content
                    $content = Storage::get($file->name);
                    
                    // Store in public disk
                    Storage::disk('public')->put($file->name, $content);
                    
                    $this->info("Migrated: {$file->name}");
                    $migrated++;
                } else {
                    $this->warn("File not found in private storage: {$file->name}");
                    $failed++;
                }
            } catch (\Exception $e) {
                $this->error("Failed to migrate {$file->name}: {$e->getMessage()}");
                $failed++;
            }
        }

        $this->info("\nMigration complete!");
        $this->info("Migrated: {$migrated}");
        $this->info("Failed: {$failed}");

        return 0;
    }
}
