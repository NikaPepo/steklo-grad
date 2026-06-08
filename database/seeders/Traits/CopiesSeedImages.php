<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait CopiesSeedImages
{
    protected function copySeedImage(string $url, string $folder): string
    {
        $source =  storage_path("app/public/seed-images/$url");

        if (!file_exists($source)) {
            throw new \RuntimeException(
                "Seed image not found: {$source}"
            );
        }

        $extension = pathinfo($source, PATHINFO_EXTENSION);
        $target = "$folder/" . Str::uuid() . ".$extension";
        Storage::disk('public')->put($target, file_get_contents(
                $source
            )
        );
        return $target;
    }
}