<?php

namespace App\Helpers;

class AssetHelper
{
    /**
     * Get the versioned asset path based on file modification time.
     */
    public static function versioned(string $path): string
    {
        $realPath = public_path($path);

        if (file_exists($realPath)) {
            return asset($path).'?v='.filemtime($realPath);
        }

        return asset($path);
    }
}
