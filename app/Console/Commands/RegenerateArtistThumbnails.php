<?php

namespace App\Console\Commands;

use App\Models\Artist;
use App\Support\ArtistThumbnailGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RegenerateArtistThumbnails extends Command
{
    protected $signature = 'artists:regenerate-thumbnails';

    protected $description = 'Rebuild grid thumbnails from each artist photo (GD extension required)';

    public function handle(): int
    {
        $disk = Storage::disk('public');

        foreach (Artist::whereNotNull('photo')->cursor() as $artist) {
            $oldThumb = $artist->thumbnail;
            $newThumb = ArtistThumbnailGenerator::generate($artist->photo);

            if (! $newThumb) {
                $this->warn("Skipped artist #{$artist->id} ({$artist->name}): could not process {$artist->photo}");

                continue;
            }

            if ($oldThumb && $oldThumb !== $newThumb) {
                $disk->delete($oldThumb);
            }

            $artist->forceFill(['thumbnail' => $newThumb])->saveQuietly();
            $this->line("Artist #{$artist->id}: {$newThumb}");
        }

        $this->info('Done.');

        return self::SUCCESS;
    }
}
