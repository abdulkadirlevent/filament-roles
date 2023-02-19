<?php

namespace App\Filament\Resources\PostsResource\Pages;


use App\Filament\Resources\PostsResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePosts extends CreateRecord
{
    protected static string $resource = PostsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Post kaydedildi';
    }
}
