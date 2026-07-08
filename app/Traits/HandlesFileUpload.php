<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesFileUpload
{
    protected array $allowedMimes = ['jpg', 'jpeg', 'png', 'webp'];
    protected int $maxFileSize = 2048; // KB

    public function uploadFile(UploadedFile $file, string $folder, ?string $deleteOld = null, ?array $options = []): string
    {
        $mimes = $options['mimes'] ?? $this->allowedMimes;
        $maxSize = $options['maxSize'] ?? $this->maxFileSize;

        if ($deleteOld) {
            $this->deleteFile($deleteOld);
        }

        return $file->store($folder, 'public');
    }

    public function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function uploadMultiple(array $files, string $folder): array
    {
        $paths = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $paths[] = $this->uploadFile($file, $folder);
            }
        }
        return $paths;
    }
}
