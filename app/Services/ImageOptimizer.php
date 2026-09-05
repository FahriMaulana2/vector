<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageOptimizer
{
    /**
     * Convert an uploaded image to WebP format using native PHP GD.
     *
     * @param  UploadedFile  $file  The uploaded image file.
     * @param  string  $directory  Target directory inside the 'public' disk (e.g., 'marketplaces', 'popups').
     * @param  int  $quality  WebP compression quality (0-100). Default is 85.
     * @param  string|null  $oldPath  Optional relative path to an old file to delete upon successful conversion.
     * @return string|null Relative storage path of the saved WebP image, or null on failure.
     */
    public static function convertToWebp(UploadedFile $file, string $directory, int $quality = 85, ?string $oldPath = null): ?string
    {
        if (! extension_loaded('gd') || ! $file->isValid()) {
            return null;
        }

        $mimeType = $file->getMimeType();
        $realPath = $file->getRealPath();

        if (! $realPath || ! in_array($mimeType, ['image/jpeg', 'image/png', 'image/webp'], true)) {
            return null;
        }

        $image = match ($mimeType) {
            'image/jpeg' => @imagecreatefromjpeg($realPath),
            'image/png' => @imagecreatefrompng($realPath),
            'image/webp' => @imagecreatefromwebp($realPath),
            default => null,
        };

        if (! $image) {
            return null;
        }

        // Preserve alpha channel transparency for PNG images
        if ($mimeType === 'image/png') {
            imagealphablending($image, false);
            imagesavealpha($image, true);
        }

        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'-'.Str::random(8).'.webp';
        $relativeDirectory = trim($directory, '/');
        $relativePath = $relativeDirectory.'/'.$filename;

        $disk = Storage::disk('public');
        $fullStoragePath = $disk->path($relativePath);

        $dirPath = dirname($fullStoragePath);
        if (! is_dir($dirPath)) {
            mkdir($dirPath, 0755, true);
        }

        $success = imagewebp($image, $fullStoragePath, $quality);
        imagedestroy($image);

        if (! $success || ! file_exists($fullStoragePath)) {
            return null;
        }

        // Safely delete old image after new WebP is successfully created
        if ($oldPath && $disk->exists($oldPath)) {
            $disk->delete($oldPath);
        }

        return $relativePath;
    }
}
