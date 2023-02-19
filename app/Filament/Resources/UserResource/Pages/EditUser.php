<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Kullanıcı güncelleme')
            ->body('**Kullanıcı** başarıyla güncellendi')
            ->actions([
                Action::make('Göster')->button()->close(),
                Action::make('Kapat')->button()->color('secondary')->close(),
            ])
    ->send();
        //return 'Kullanıcı güncellendi';
    }
    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
