<?php

namespace App\Filament\Resources\PostsResource\Pages;

use App\Filament\Resources\PostsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPosts extends ViewRecord
{
    protected static string $resource = PostsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
