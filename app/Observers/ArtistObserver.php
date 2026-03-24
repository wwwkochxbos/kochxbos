<?php

namespace App\Observers;

use App\Models\Artist;
use App\Support\ArtistThumbnailGenerator;
use Illuminate\Support\Facades\Storage;

class ArtistObserver
{
    /** @var array<int, ?string> */
    private static array $previousThumbnailPaths = [];

    public function saving(Artist $artist): void
    {
        if (! $artist->isDirty('photo')) {
            return;
        }

        self::$previousThumbnailPaths[spl_object_id($artist)] = $artist->exists
            ? $artist->getOriginal('thumbnail')
            : null;
    }

    public function saved(Artist $artist): void
    {
        $key = spl_object_id($artist);
        $previousThumbnail = self::$previousThumbnailPaths[$key] ?? null;
        unset(self::$previousThumbnailPaths[$key]);

        $photoChanged = $artist->wasChanged('photo');
        $needsThumbBackfill = $artist->photo && empty($artist->thumbnail);

        if (! $photoChanged && ! $needsThumbBackfill) {
            return;
        }

        $disk = Storage::disk('public');

        if ($artist->photo) {
            $newThumb = ArtistThumbnailGenerator::generate($artist->photo);
            if ($newThumb) {
                if ($previousThumbnail && $previousThumbnail !== $newThumb) {
                    $disk->delete($previousThumbnail);
                }
                $artist->forceFill(['thumbnail' => $newThumb])->saveQuietly();
            }

            return;
        }

        if ($previousThumbnail) {
            $disk->delete($previousThumbnail);
        }
        $artist->forceFill(['thumbnail' => null])->saveQuietly();
    }

    public function deleted(Artist $artist): void
    {
        $disk = Storage::disk('public');
        if ($artist->thumbnail) {
            $disk->delete($artist->thumbnail);
        }
        if ($artist->photo) {
            $disk->delete($artist->photo);
        }
    }
}
