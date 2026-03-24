<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtistThumbnailGenerator
{
    /** Max width for generated grid thumbnails (px). */
    public const MAX_WIDTH = 480;

    public static function generate(string $photoPath): ?string
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($photoPath)) {
            return null;
        }

        $fullPath = $disk->path($photoPath);
        $info = @getimagesize($fullPath);
        if ($info === false) {
            return null;
        }

        $src = match ($info[2]) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($fullPath),
            IMAGETYPE_PNG => @imagecreatefrompng($fullPath),
            IMAGETYPE_GIF => @imagecreatefromgif($fullPath),
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($fullPath) : null,
            default => null,
        };

        if ($src === false || $src === null) {
            return null;
        }

        $w = imagesx($src);
        $h = imagesy($src);
        $maxW = self::MAX_WIDTH;

        if ($w <= 0 || $h <= 0) {
            imagedestroy($src);

            return null;
        }

        if ($w <= $maxW) {
            $newW = $w;
            $newH = $h;
        } else {
            $newW = $maxW;
            $newH = (int) round($h * ($maxW / $w));
        }

        $dst = imagecreatetruecolor($newW, $newH);
        $white = imagecolorallocate($dst, 255, 255, 255);
        imagefill($dst, 0, 0, $white);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $w, $h);
        imagedestroy($src);

        $thumbRelative = 'artists/thumbnails/'.Str::uuid().'.jpg';
        $disk->makeDirectory(dirname($thumbRelative));
        $destFull = $disk->path($thumbRelative);

        if (! imagejpeg($dst, $destFull, 88)) {
            imagedestroy($dst);

            return null;
        }

        imagedestroy($dst);

        return $thumbRelative;
    }
}
