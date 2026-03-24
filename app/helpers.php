<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('public_storage_url')) {
    /**
     * Public URL for files on the "public" disk (served via /media route on restrictive hosts).
     */
    function public_storage_url(?string $path): string
    {
        if ($path === null || $path === '') {
            return '';
        }

        return Storage::disk('public')->url($path);
    }
}
