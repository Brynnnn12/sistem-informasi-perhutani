<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Pastikan published_at terisi jika kosong
        if (empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        // Auto-set created_by jika belum terisi
        if (empty($data['created_by'])) {
            $data['created_by'] = auth()->id();
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Artikel berhasil dibuat dan dipublikasikan!';
    }
}
