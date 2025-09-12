<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class FileHelper
{
    /**
     * Store or update file directly using file system
     */
    public static function storeOrUpdateFile(UploadedFile $file, string $directory, ?string $oldFilePath = null, array $options = []): ?string
    {
        $options = array_merge([
            'optimize' => false,
            'resize' => null,
            'quality' => 90,
            'filename' => null,
            'format' => null, // jpg, png, etc
        ], $options);

        try {
            $publicPath = public_path($directory);
            if (!File::exists($publicPath)) {
                File::makeDirectory($publicPath, 0755, true);
            }

            // Delete old file
            if ($oldFilePath && File::exists(public_path($oldFilePath))) {
                File::delete(public_path($oldFilePath));
            }

            $filename = $options['filename'] ?? self::generateFilename($file);
            $fullPath = $publicPath . '/' . $filename;
            $relativePath = $directory . '/' . $filename;

            if ($options['optimize'] && self::isImage($file)) {
                $image = Image::make($file);

                if ($options['resize']) {
                    $resize = $options['resize'];
                    $width = $resize['width'] ?? null;
                    $height = $resize['height'] ?? null;
                    $maintainAspect = $resize['aspectRatio'] ?? true;

                    if ($maintainAspect) {
                        $image->resize($width, $height, fn($c) => $c->aspectRatio());
                    } else {
                        $image->resize($width, $height);
                    }
                }

                $image->encode($options['format'], $options['quality'])->save($fullPath);
            } else {
                $file->move($publicPath, $filename);
            }

            return $relativePath;
        } catch (\Exception $e) {
            Log::error('File system storage error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Store multiple files
     */
    public static function storeMultipleFiles(array $files, string $directory, array $options = []): array
    {
        return array_filter(array_map(function ($file) use ($directory, $options) {
            return $file instanceof UploadedFile ? self::storeOrUpdateFile($file, $directory, null, $options) : null;
        }, $files));
    }

    /**
     * Delete a file using native file system
     */
    public static function deleteFile(string $filePath): bool
    {
        try {
            $fullPath = public_path($filePath);
            return File::exists($fullPath) ? File::delete($fullPath) : true;
        } catch (\Exception $e) {
            Log::error('File deletion error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Generate unique filename
     */
    private static function generateFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        return Str::slug($baseName) . '_' . time() . '_' . Str::random(5) . '.' . $extension;
    }

    /**
     * Check if file is an image
     */
    private static function isImage(UploadedFile $file): bool
    {
        return in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
    }

    /**
     * Get file info from file system
     */
    public static function getFileInfo(string $filePath): ?array
    {
        try {
            $fullPath = public_path($filePath);
            if (!File::exists($fullPath)) return null;

            return [
                'path' => $filePath,
                'size' => File::size($fullPath),
                'mimeType' => File::mimeType($fullPath),
                'lastModified' => File::lastModified($fullPath),
                'url' => asset($filePath),
            ];
        } catch (\Exception $e) {
            Log::error('File info error: ' . $e->getMessage());
            return null;
        }
    }
}



/**--------------------------------------------------------------------------------------------------------------------------------
 *
 *--------------------------------------------------------------------------------------------------------------------------------
 */

// $imagePath = FileHelper::storeOrUpdateFile(
//     $image, 'properties/images', null,
//     [
//         'optimize' => true,
//         'resize' => ['width' => 1200, 'height' => 800, 'aspectRatio' => true],
//         'quality' => 80
//     ]
// );

/**--------------------------------------------------------------------------------------------------------------------------------
 *
 *--------------------------------------------------------------------------------------------------------------------------------
 */



